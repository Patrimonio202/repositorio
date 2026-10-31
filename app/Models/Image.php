<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Throwable;

// rendimiento v1.2 (30/10/2026): miniaturas WebP generadas por el propio codigo (sin scripts).
//   'media'  : 1000 px de ancho, para listados y tarjetas
//   'grande' : 1920 px de ancho, para los banners del carrusel
// Se guardan en storage/app/public/miniaturas/... y NUNCA reemplazan al original.
// Se crean al subir la imagen desde el panel de administracion y, si faltan (imagenes
// antiguas o reemplazadas), la primera vez que se muestran. Si algo falla (sin GD, imagen
// enorme, poca memoria) se muestra el original, como antes.
class Image extends Model
{
    use HasFactory;

    private const ANCHO = ['media' => 1000, 'grande' => 1920];
    private const CALIDAD = ['media' => 82, 'grande' => 85];
    private const MAX_PIXELES = 40000000;   // evita agotar la memoria con escaneos gigantes
    private const PRESUPUESTO = 4.0;        // segundos maximos por peticion creando miniaturas

    private static float $gastado = 0.0;
    private static ?bool $disponible = null;

    protected $fillable=['url','urlarchivo', 'urlyoutube'];

    //relacion polimorfica
    public function imageable(){
        return $this->morphTo();
    }

    // ---------------------------------------------------------------- URLs para las vistas

    public function getMiniaturaUrlAttribute(): string
    {
        return self::urlMiniatura($this->url);
    }

    public static function urlMiniatura(?string $ruta): string
    {
        return self::url($ruta, 'media');
    }

    public static function urlGrande(?string $ruta): string
    {
        return self::url($ruta, 'grande');
    }

    // celular: version de 1000 px; computador: version de 1920 px
    public static function srcsetBanner(?string $ruta): string
    {
        $chica = self::urlMiniatura($ruta);
        $grande = self::urlGrande($ruta);
        return $chica === $grande ? '' : $chica . ' 1000w, ' . $grande . ' 1920w';
    }

    // ---------------------------------------------------------------- uso desde el panel

    // Al subir una imagen: crea las miniaturas de inmediato
    public static function generarVariantes(?string $ruta, bool $banner = false): void
    {
        $ruta = (string) $ruta;
        if ($ruta === '') {
            return;
        }
        self::asegurar($ruta, 'media', true);
        if ($banner) {
            self::asegurar($ruta, 'grande', true);
        }
    }

    // Al reemplazar o borrar una imagen: elimina sus miniaturas
    public static function eliminarVariantes(?string $ruta): void
    {
        $ruta = (string) $ruta;
        if ($ruta === '' || str_contains($ruta, '..') || !self::esLocal()) {
            return;
        }
        try {
            Storage::delete([self::rutaMiniatura($ruta, 'media'), self::rutaMiniatura($ruta, 'grande')]);
        } catch (Throwable $e) {
            // no es critico
        }
    }

    // ---------------------------------------------------------------- internos

    private static function url(?string $ruta, string $variante): string
    {
        $ruta = (string) $ruta;
        if ($ruta !== '' && self::asegurar($ruta, $variante, false)) {
            return Storage::url(self::rutaMiniatura($ruta, $variante));
        }
        return Storage::url($ruta);
    }

    private static function rutaMiniatura(string $ruta, string $variante): string
    {
        return ($variante === 'grande' ? 'miniaturas/grande/' : 'miniaturas/') . $ruta . '.webp';
    }

    private static function esLocal(): bool
    {
        $disco = config('filesystems.default');
        return config("filesystems.disks.$disco.driver") === 'local';
    }

    private static function disponible(): bool
    {
        if (self::$disponible === null) {
            self::$disponible = self::esLocal()
                && function_exists('imagewebp')
                && function_exists('imagecreatetruecolor');
        }
        return self::$disponible;
    }

    // true si existe una miniatura vigente (la crea si hace falta y se puede)
    private static function asegurar(string $ruta, string $variante, bool $forzar): bool
    {
        try {
            if (!self::disponible() || str_contains($ruta, '..') || str_starts_with($ruta, 'miniaturas/')) {
                return false;
            }
            $origen = Storage::path($ruta);
            $destino = Storage::path(self::rutaMiniatura($ruta, $variante));
            $mo = @filemtime($origen);
            if ($mo === false) {
                return false;
            }
            $md = @filemtime($destino);
            if ($md !== false && $md >= $mo) {
                return true;   // vigente: el original no cambio despues de crearla
            }

            // No bloquear una visita publica procesando imagenes grandes.
            // Las variantes se generan al subirlas desde administracion.
            if (!$forzar) {
                return false;
            }

            return self::generar($origen, $destino, $variante, $forzar);
        } catch (Throwable $e) {
            return false;
        }
    }

    private static function generar(string $origen, string $destino, string $variante, bool $forzar): bool
    {
        if (!$forzar && self::$gastado > self::PRESUPUESTO) {
            return false;   // en esta peticion ya se gasto el tiempo permitido; sera en la proxima visita
        }
        $t0 = microtime(true);
        $im = null;
        $dst = null;
        try {
            $info = @getimagesize($origen);
            if (!$info) {
                return false;
            }
            [$w, $h, $tipo] = $info;
            if ($w < 1 || $h < 1 || $w * $h > self::MAX_PIXELES || !self::memoriaSuficiente($w * $h * 5 + 24 * 1048576)) {
                return false;
            }

            $im = match ($tipo) {
                IMAGETYPE_JPEG => @imagecreatefromjpeg($origen),
                IMAGETYPE_PNG => @imagecreatefrompng($origen),
                IMAGETYPE_WEBP => @imagecreatefromwebp($origen),
                IMAGETYPE_GIF => @imagecreatefromgif($origen),
                default => false,
            };
            if (!$im) {
                return false;
            }
            if (!imageistruecolor($im)) {
                imagepalettetotruecolor($im);
            }

            // respetar la orientacion de las fotos (al reescalar se pierde el dato EXIF)
            if ($tipo === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
                $exif = @exif_read_data($origen);
                $orientacion = is_array($exif) ? ($exif['Orientation'] ?? 1) : 1;
                $giro = [3 => 180, 6 => -90, 8 => 90][$orientacion] ?? 0;
                if ($giro !== 0) {
                    $girada = imagerotate($im, $giro, 0);
                    if ($girada) {
                        imagedestroy($im);
                        $im = $girada;
                    }
                }
            }

            $w = imagesx($im);
            $h = imagesy($im);
            $nw = min($w, self::ANCHO[$variante]);
            $nh = max(1, (int) round($h * $nw / $w));

            $dst = imagecreatetruecolor($nw, $nh);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagefill($dst, 0, 0, imagecolorallocatealpha($dst, 255, 255, 255, 127));
            imagecopyresampled($dst, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
            imagedestroy($im);
            $im = null;

            $dir = dirname($destino);
            if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
                return false;
            }
            $tmp = $destino . '.' . bin2hex(random_bytes(4)) . '.tmp';
            $ok = imagewebp($dst, $tmp, self::CALIDAD[$variante]);
            imagedestroy($dst);
            $dst = null;
            if (!$ok || !is_file($tmp) || filesize($tmp) === 0) {
                @unlink($tmp);
                return false;
            }
            if (!@rename($tmp, $destino)) {
                @unlink($tmp);
                return false;
            }
            @chmod($destino, 0644);
            return true;
        } catch (Throwable $e) {
            return false;
        } finally {
            if ($im) {
                imagedestroy($im);
            }
            if ($dst) {
                imagedestroy($dst);
            }
            self::$gastado += microtime(true) - $t0;
        }
    }

    // Evita un error fatal por memoria: solo procesa si cabe (sube el limite de la peticion si hace falta)
    private static function memoriaSuficiente(int $necesario): bool
    {
        $limite = self::bytes((string) ini_get('memory_limit'));
        if ($limite < 0) {
            return true;
        }
        $falta = memory_get_usage() + $necesario;
        if ($falta > $limite) {
            @ini_set('memory_limit', (string) min($falta + 64 * 1048576, 1024 * 1048576));
            $limite = self::bytes((string) ini_get('memory_limit'));
        }
        return $limite < 0 || $falta <= $limite;
    }

    private static function bytes(string $valor): int
    {
        $valor = trim($valor);
        if ($valor === '' || $valor === '-1') {
            return -1;
        }
        $n = (int) $valor;
        return match (strtolower(substr($valor, -1))) {
            'g' => $n * 1073741824,
            'm' => $n * 1048576,
            'k' => $n * 1024,
            default => $n,
        };
    }
}
