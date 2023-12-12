@component('mail::message')
# Hola Administrador
{{$data['name']}}  te ha enviado un mensaje desde la web de el repositorio virtual
@component('mail::panel')
{{$data['message']}} 
@endcomponent
Correo de contacto:  {{$data['email']}} 
<br>
<a href="{{$data['pagina']}} ">link de página</a>  
@endcomponent