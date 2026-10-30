<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- meta de facebook -->
    <title>@yield('title')</title>
    <meta property="og:title" content="@yield('ogTitle')" />
    <meta property="og:site_name" content="Archivos patrimoniales El Santuario" />
    <meta property="og:url" content="@yield('ogUrl', 'https://patrimonioelsantuario.gov.co')" />
    <meta property="og:description" content="@yield('ogDesc', 'Archivos patrimoniales El Santuario')" />    
    <meta property="og:locale" content="es" />
    <meta property="og:image" content="@yield('ogImage', 'https://patrimonioelsantuario.gov.co/storage/Imagenes/ImagenCompartirRepositorio.jpg')" />
    <meta property="og:type" content="@yield('ogType', 'image/png')" />
    <meta property="og:image:width" content="526" />
    <meta property="og:image:height" content="275" />
    <meta property="fb:app_id" content="xxxxxxxxx" />

    <!-- hasta aqui propiedades para compartir-->

    {{-- <title>{{ config('app.name', 'Archivos patrimoniales el santuario') }}</title> --}}

    <!-- Favicon -->
    <!--  <link rel="icon" href="/favicon-navegadores.png" sizes="32x32" type="image/png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Storage::url('Imagenes/Favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fonts de google-->
    <link href="{{ asset('Fonts/stylefont.css') }}" rel="stylesheet" />


    <!--flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    {{-- rendimiento v1.0 (30/10/2026): se retira el compilador de Tailwind por CDN (corria en el navegador de cada visitante); los estilos salen de @vite --}}

    <!-- para el efecto de imagenes -->
    <link href="{{ asset('vendor/flowbite/css/efectoimagenes.css') }}" rel="stylesheet" />
    <!--hasta aqui -->

    <!-- para el fantsoware -->
    <link href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css') }}" rel="stylesheet" />
    <!--hasta aqui -->


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- rendimiento v1.0 (30/10/2026): Glider retirado (no se usaba en ninguna vista) --}}



    <!-- video de youtube -->
    <x-embed-styles />
    <!-- Styles -->
    @livewireStyles

    <!-- prueba de zoom imagen-->
    <link href="{{ asset('csspersonalizados/csszoomimage.css') }}" rel="stylesheet" />




</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        @livewire('navigation', ['colorbanner' => 'white']) <!-- este es el menu que acabamos de crear -->

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <!--menu visible -->
        {{-- <x-speed-dial /> --}}
         @livewire('menulw')
        <!--Hasta aqui -->
        <x-suscribirse2 />
    </div>

    {{-- @stack('modals') --}}


    @livewireScripts
    @stack('js')

    <!--Este script es para copiar el texto -->
    <script>
        function myFunction() {
            const $content = document.getElementById('myInput');
            $content.select();
            document.execCommand('copy');
        }
    </script>


</body>

</html>
