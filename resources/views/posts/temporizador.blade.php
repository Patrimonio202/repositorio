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
    <meta property="og:type" content="@yield('ogType', 'Multimedia')" />
    <meta property="og:locale" content="es" />
    <meta property="og:image" content="@yield('ogImage', 'https://proyectoeducacion.s3.us-east-2.amazonaws.com/archivos/YC2Ebqcx.jpg')" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />
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
    {{-- <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'> --}}
    <link href="{{ asset('Fonts/stylefont.css') }}" rel="stylesheet" />


    <!--flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- para el efecto de imagenes -->
    <link href="{{ asset('vendor/flowbite/css/efectoimagenes.css') }}" rel="stylesheet" />
    <!--hasta aqui -->

    <!-- para el fantsoware -->
    <link href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css') }}" rel="stylesheet" />
    <!--hasta aqui -->

    <!-- Glider .css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css"
        integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--hasta aqui -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Glider .js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"
        integrity="sha512-AZURF+lGBgrV0WM7dsCFwaQEltUV5964wxMv+TSzbb6G1/Poa9sFxaCed8l8CcFRTiP7FsCgCyOm/kf1LARyxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--hasta aqui -->

    <!-- video de youtube -->
    <x-embed-styles />
    <!-- Styles -->
    @livewireStyles

    <!-- prueba de zoom imagen-->
    <link href="{{ asset('csspersonalizados/csszoomimage.css') }}" rel="stylesheet" />

    <script src="{{ asset('jspersonalizados/temporizador.js')}}"></script>
    
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen">
        <!-- Page Content -->
        <div class="flex flex-col h-screen ">
            <div class="   lg:h-screen  w-full bg-cover justify-center items-center text-center "
                style=" background-image: url('../Background_Prelanzamiento0.png')">
                
            <div class="flex  mt-10 mb-32 lg:mb-10 justify-center items-center">
                <img class="   w-80  object-cover" src="{{ Storage::url('Imagenes/Repositorio_grisoscuro.png') }}" >
            </div>
                

                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid  grid-cols-4 mb-20 ">
                    <div>
                        <p id="days" class=" font-bold text-5xl md:text-7xl lg:text-9xl" >0</p>
                        <span class=" text-sm font-semibold">Dias</span>
                    </div>

                    <div>
                        <p class=" font-bold text-5xl md:text-7xl lg:text-9xl" id="hours">0</p>
                        <span class=" text-sm font-semibold">Horas</span>
                    </div>
                    <div>
                        <p class=" font-bold text-5xl md:text-7xl lg:text-9xl" id="minutes">0</p>
                        <span class=" text-sm font-semibold">Minutos</span>
                    </div>
                    <div>
                        <p  class=" font-bold text-5xl md:text-7xl lg:text-9xl" id="seconds">0</p>
                        <span class=" text-sm font-semibold">Segundos</span>
                    </div>
                </div>

                <div class="hidden lg:block -mt-52  bottom-0 ">
                    <img class="  max-w-screen-lg object-cover " src="{{ Storage::url('Imagenes/segundaimagencontador.png') }}" >
                </div>


            </div>

            <footer class=" flex flex-col items-center  bg-neutral-900 text-center text-white">
                <div class="container px-6 mb-1 ">
                    <!-- Patrocinado por relative hidden lg:block   lg:bottom-44-->
                    {{-- footer solo para lg --}}
                    <div class="grid grid-cols-2 lg:grid-cols-8 lg:gap-2 text-center  ">
                        <div class="col-span-2  lg:col-span-4  text-left lg:mt-2 ">
                            <p>
                                Un proyecto de:
                            </p>
                        </div>

                        <div class="hidden lg:block  lg:col-span-4 text-left mt-2  ">
                            <p>
                                Con el respaldo de:
                            </p>
                        </div>

                        <div>
                            <img src="{{ Storage::url('Imagenes/1.Logo_Con la gente por El Santuario.png') }}"
                                alt="Con la gente por El Santuario" class=" object-cover w-full" />
                        </div>
                        <div>
                            <img src="{{ Storage::url('Imagenes/2.Logo_Soy Cultura.png') }}" alt="Soy Cultura"
                                class="object-cover  w-full" />
                        </div>
                        <div>
                            <img src="{{ Storage::url('Imagenes/3.Logo_Vigías del Patrimonio El Santuario.png') }}"
                                alt="Vigias del patrimonio El Santuario" class=" object-cover  w-full" />
                        </div>
                        <div>
                            <img src="{{ Storage::url('Imagenes/4.Logo_Biblioteca Municipal.png') }}"
                                alt="Biblioteca pública municipal" class=" object-cover   w-full" />
                        </div>

                        <div class="block  lg:hidden  col-span-2  text-left   ">
                            <p>
                                Con el respaldo de:
                            </p>
                        </div>

                        <div class="flex-1 items-center justify-center">
                            <img src="{{ Storage::url('Imagenes/5.Logo_Archivo General de la Nación.png') }}"
                                alt="Archivo general de la nación" class="object-cover   w-full" />
                        </div>
                        <div class="flex-1 items-center justify-center">
                            <img src="{{ Storage::url('Imagenes/6.Logo_Biblioteca Nacional.png') }}"
                                alt="Biblioteca nacional de Colombia" class="object-cover   w-full" />
                        </div>
                        <div class="flex-1 items-center justify-center">
                            <img src="{{ Storage::url('Imagenes/7.Logo_Premio Nacional de Biliotecas Públicas.png') }}"
                                alt="Bibioteca públicas" class="object-cover  w-full" />
                        </div>
                        <div class="flex-1 items-center justify-center">
                            <img src="{{ Storage::url('Imagenes/8.Logo_Biblioteca Pública Piloto.png') }}"
                                alt="Biblioteca pública piloto" class="object-cover   w-full" />
                        </div>
                    </div>


                </div>



            </footer>



        </div>


    </div>

    {{-- @stack('modals') --}}


    @livewireScripts
    @stack('js')

   


</body>

</html>
