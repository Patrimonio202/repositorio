{{-- suscripcion/resultado - v1.0 (30/10/2026): resultado de confirmar o dar de baja una suscripcion --}}
<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 mb-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose text-center">
                <h1>{{ $titulo }}</h1>
                <p>{{ $mensaje }}</p>
                <p><a href="{{ url('/') }}">Volver al inicio</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
