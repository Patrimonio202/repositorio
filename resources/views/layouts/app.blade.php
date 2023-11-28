<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">       

         <!-- meta de facebook -->
         <title>@yield('title')</title>
        <meta property="og:title" content="@yield('ogTitle')"/>
<meta property="og:site_name" content="Archivos patrimoniales El Santuario"/>
 <meta property="og:url" content="@yield('ogUrl', 'https://patrimonioelsantuario.gov.co')"/> 
<meta property="og:description" content="@yield('ogDesc', 'Archivos patrimoniales El Santuario')"/>
<meta property="og:type" content="@yield('ogType', 'Multimedia')"/>
<meta property="og:locale" content="es"/>
<meta property="og:image" content="@yield('ogImage', 'https://proyectoeducacion.s3.us-east-2.amazonaws.com/archivos/YC2Ebqcx.jpg')"/>
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="400" />
<meta property="fb:app_id" content="xxxxxxxxx"/>

 <!-- hasta aqui propiedades para compartir-->

        {{-- <title>{{ config('app.name', 'Archivos patrimoniales el santuario') }}</title> --}}

        <!-- Favicon -->
        <!--  <link rel="icon" href="/favicon-navegadores.png" sizes="32x32" type="image/png"> -->
        <link 
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ Storage::url('Imagenes/Favicon.png')}}"
        />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 
        
         <!-- Fonts de google-->        
        {{-- <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'> --}}
        <link href="{{ asset('Fonts/stylefont.css')}}"  rel="stylesheet" />  
        

          <!--flowbite -->
          <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
          <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
          <script src="https://cdn.tailwindcss.com"></script>  

         <!-- para el efecto de imagenes -->
        <link href="{{ asset('vendor/flowbite/css/efectoimagenes.css')}}"  rel="stylesheet" />      
         <!--hasta aqui -->

          <!-- para el fantsoware -->
        <link href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css')}}"  rel="stylesheet" />      
        <!--hasta aqui -->

         <!-- Glider .css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <!--hasta aqui -->      

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
        
        <!-- Glider .js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js" integrity="sha512-AZURF+lGBgrV0WM7dsCFwaQEltUV5964wxMv+TSzbb6G1/Poa9sFxaCed8l8CcFRTiP7FsCgCyOm/kf1LARyxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <!--hasta aqui -->

        <!-- video de youtube -->
        <x-embed-styles />
        <!-- Styles -->
        @livewireStyles

      <!-- prueba de zoom imagen-->
      <link href="{{ asset('csspersonalizados/csszoomimage.css')}}"  rel="stylesheet" />    


    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">      
         
          @livewire('navigation',['colorbanner' => 'white'])           <!-- este es el menu que acabamos de crear -->    
        
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
             <x-suscribirse2 /> 
        </div>

        {{-- @stack('modals') --}}
       

        @livewireScripts   
        @stack('js')    
       

    </body>
</html>
