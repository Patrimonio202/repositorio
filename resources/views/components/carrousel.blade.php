<div id="default-carousel" class="relative w-full " data-carousel="slide" data-carousel-interval="7000">
    <!-- Carousel wrapper -->
    <div class="relative h-20 overflow-hidden rounded-lg md:h-96 lg:h-96 ">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out " data-carousel-item>
            <a href="{{ route('inicio.acercade') }}">
                <img src="{{ Storage::url('Imagenes/Imagen-barner-1.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </a>
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out cursor-pointer" data-carousel-item>
            <a href="{{ route('posts.colecciones', 'archivo-antonio-botero') }}">
                <img src="{{ Storage::url('Imagenes/Imagen-barner-2.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </a>
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out cursor-pointer" data-carousel-item>
            <a href="{{ route('posts.colecciones', 'archivo-el-santuariano') }}">
                <img src="{{ Storage::url('Imagenes/Imagen-barner-3.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </a>
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out cursor-pointer" data-carousel-item>
            <a href="{{ route('posts.colecciones', 'biblioteca-publica-municipal') }}">
                <img src="{{ Storage::url('Imagenes/Imagen-barner-4.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </a>
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out cursor-pointer" data-carousel-item>
            <a href="{{ route('posts.colecciones', 'archivo-patrimonial-de-el-santuario') }}">
                <img src="{{ Storage::url('Imagenes/Imagen-barner-5.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </a>
        </div>
    </div>
    <!-- Slider indicador -->
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        <button type="button" class=" hidden lg:block w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
            data-carousel-slide-to="0"></button>
        <button type="button" class="hidden lg:block w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
            data-carousel-slide-to="1"></button>
        <button type="button" class="hidden lg:block w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
            data-carousel-slide-to="2"></button>
        <button type="button" class="hidden lg:block w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
            data-carousel-slide-to="3"></button>
        <button type="button" class="hidden lg:block w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
            data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center  w-5 h-5 lg:w-10 lg:h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            {{-- <svg class="w-2 h-2 lg:w-4 lg:h-4 text-white dark:text-gray-800" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg> --}}
            {{-- <i class="fa-solid fa-angle-left" style="color: #ffffff;"></i> --}}
            <svg class="w-2 h-2 lg:w-4 lg:h-4 text-white dark:text-gray-800" xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-5 h-5 lg:w-10 lg:h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            {{-- <svg class="w-2 h-2 lg:w-4 lg:h-4 text-white dark:text-gray-800" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>  --}}
            <svg class="w-2 h-2 lg:w-4 lg:h-4 text-white dark:text-gray-800" xmlns="http://www.w3.org/2000/svg"
                height="1em"
                viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
            </svg>
            {{-- <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i> --}}
            <span class="sr-only">Next</span>
        </span>
    </button>

</div>
