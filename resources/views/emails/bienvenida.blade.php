@component('mail::message')
# Introducción

El cuerpo del mensaje


@component('mail::button', ['url' => 'www.google.com'])
Texto del boton
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent