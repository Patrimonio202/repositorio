<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable=['url','urlarchivo', 'urlyoutube'];

    //relacion polimorfica
    public function imageable(){
        return $this->morphTo();
    }

    // rendimiento v1.0 (30/10/2026): URL de la miniatura (WebP) para listados.
    // Si la miniatura no existe devuelve el original. El original nunca se modifica:
    // se usa al abrir la publicacion y al descargar.
    public function getMiniaturaUrlAttribute(): string
    {
        return self::urlMiniatura($this->url);
    }

    public static function urlMiniatura(?string $ruta): string
    {
        $ruta = (string) $ruta;
        if ($ruta !== '') {
            $mini = 'miniaturas/' . $ruta . '.webp';
            if (Storage::exists($mini)) {
                return Storage::url($mini);
            }
        }
        return Storage::url($ruta);
    }
}
