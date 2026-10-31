<?php

namespace App\Http\Controllers;

use App\Mail\SuscripcionMailable;
use App\Models\Suscriptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

// SuscriptorController - v1.0 (30/10/2026): "Suscribete a nuestro boletin" del pie de pagina.
// Flujo con doble confirmacion: la persona escribe su correo -> recibe un enlace -> confirma.
// Asi nadie puede inscribir el correo de otra persona. Proteccion contra bots: limite por IP en la
// ruta (throttle), campo trampa (honeypot) y un solo correo cada 10 minutos por direccion.
class SuscriptorController extends Controller
{
    private const REENVIO_MINUTOS = 10;

    public function store(Request $request)
    {
        $destino = $this->volver($request);

        // campo trampa: las personas no lo ven; si viene lleno es un bot -> se responde igual, sin hacer nada
        if ($request->filled('sitio_web')) {
            return redirect($destino)->with('boletin_ok', $this->mensajeOk());
        }

        $request->merge(['email' => Str::lower(trim((string) $request->input('email')))]);

        $validador = Validator::make($request->all(), [
            'email' => ['required', 'string', 'max:190', 'email:rfc'],
            'acepto' => ['accepted'],
        ], [
            'email.required' => 'Escribe tu correo electrónico.',
            'email.email' => 'El correo electrónico no parece válido.',
            'email.max' => 'El correo electrónico es demasiado largo.',
            'acepto.accepted' => 'Debes aceptar la política de privacidad para suscribirte.',
        ]);

        if ($validador->fails()) {
            return redirect($destino)->withErrors($validador, 'boletin')->withInput($request->only('email'));
        }

        $email = $request->input('email');
        $suscriptor = Suscriptor::firstOrNew(['email' => $email]);
        $ahora = now();
        $enviar = false;

        if ($suscriptor->exists && $suscriptor->activo) {
            // ya esta suscrito: no se envia nada (y la respuesta es la misma, para no revelar quien esta suscrito)
        } elseif ($suscriptor->exists && $suscriptor->updated_at && $suscriptor->updated_at->gt($ahora->copy()->subMinutes(self::REENVIO_MINUTOS))) {
            // ya se envio un correo hace poco
        } else {
            $suscriptor->token = bin2hex(random_bytes(32));
            $suscriptor->aceptado_en = $ahora;
            $suscriptor->confirmado_en = null;
            $suscriptor->baja_en = null;
            $suscriptor->save();
            $enviar = true;
        }

        if ($enviar) {
            $correo = new SuscripcionMailable(
                route('suscriptores.confirmar', $suscriptor->token),
                route('suscriptores.baja', $suscriptor->token)
            );
            // se envia al terminar la respuesta, para no hacer esperar a la persona
            app()->terminating(function () use ($correo, $email) {
                try {
                    Mail::to($email)->send($correo);
                } catch (Throwable $e) {
                    Log::warning('Boletin: no se pudo enviar el correo de confirmacion: ' . $e->getMessage());
                }
            });
        }

        return redirect($destino)->with('boletin_ok', $this->mensajeOk());
    }

    public function confirmar(string $token)
    {
        $suscriptor = $this->buscar($token);
        if (!$suscriptor) {
            return $this->resultado('Enlace no válido', 'El enlace de confirmación no es válido o ya no existe.', 404);
        }
        if (!$suscriptor->activo) {
            $suscriptor->confirmado_en = now();
            $suscriptor->baja_en = null;
            $suscriptor->save();
        }
        return $this->resultado('¡Suscripción confirmada!', 'Gracias por suscribirte. Te avisaremos de las novedades del Repositorio Digital Patrimonio Cultural El Santuario.');
    }

    public function baja(string $token)
    {
        $suscriptor = $this->buscar($token);
        if (!$suscriptor) {
            return $this->resultado('Enlace no válido', 'El enlace de baja no es válido o ya no existe.', 404);
        }
        if ($suscriptor->baja_en === null) {
            $suscriptor->baja_en = now();
            $suscriptor->save();
        }
        return $this->resultado('Te diste de baja', 'Ya no recibirás el boletín. Si fue un error, puedes volver a suscribirte desde el pie de cualquier página del sitio.');
    }

    private function buscar(string $token): ?Suscriptor
    {
        if (!preg_match('/^[a-f0-9]{64}$/', $token)) {
            return null;
        }
        return Suscriptor::where('token', $token)->first();
    }

    private function resultado(string $titulo, string $mensaje, int $codigo = 200)
    {
        return response()->view('suscripcion.resultado', compact('titulo', 'mensaje'), $codigo);
    }

    private function mensajeOk(): string
    {
        return 'Gracias. Si el correo es válido, te enviamos un mensaje para confirmar tu suscripción. Revisa también la carpeta de spam.';
    }

    // vuelve a la pagina desde donde se envio, al formulario del pie (solo dentro de este mismo sitio)
    private function volver(Request $request): string
    {
        $previa = url()->previous();
        $mismoSitio = parse_url($previa, PHP_URL_HOST) === $request->getHost();
        return ($mismoSitio ? strtok($previa, '#') : url('/')) . '#boletin';
    }
}
