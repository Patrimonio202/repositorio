<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

/**
 * ExtensionPermitida v1.0 (30/10/2026)
 * Valida la extension DECLARADA en el nombre original del archivo, porque la aplicacion
 * guarda los archivos con ese nombre. Evita nombres como "x.php", "x.php.jpg" o ".htaccess".
 */
class ExtensionPermitida implements ValidationRule
{
    public function __construct(private array $permitidas)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            return;
        }

        $nombre = $value->getClientOriginalName();
        $ext = strtolower($value->getClientOriginalExtension());

        $peligroso = preg_match('/\.(php\d*|phtml|phar|pht|phps|phpt|cgi|pl|py|sh|asp|aspx|jsp|exe|htaccess)(\.|$)/i', $nombre)
            || str_starts_with($nombre, '.');

        if ($peligroso || !in_array($ext, $this->permitidas, true)) {
            $fail('El tipo de archivo no esta permitido.');
        }
    }
}
