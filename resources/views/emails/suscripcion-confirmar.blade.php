<x-mail::message>
{{-- suscripcion-confirmar - v1.0 (30/10/2026) --}}
# Confirma tu suscripción

Recibimos una solicitud para suscribir este correo al boletín del **Repositorio Digital Patrimonio Cultural El Santuario**.

Para empezar a recibirlo, confirma tu correo:

<x-mail::button :url="$urlConfirmar">
Confirmar suscripción
</x-mail::button>

Si no fuiste tú, ignora este mensaje: no se te enviará nada.

Si más adelante quieres dejar de recibir el boletín, puedes [darte de baja aquí]({{ $urlBaja }}).

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
