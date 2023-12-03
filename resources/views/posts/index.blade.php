<x-app-layout>

    <div class="container my-4 md:my-4 lg:my-4 px-6 mx-auto   ">
        <x-carrousel />
    </div>


    <div
        class="grid grid-cols-1    lg:flex max-w-7xl lg:mx-auto mx-4   bg-white rounded-lg  shadow-lg  items-center  text-center py-8 px-6 gap-4 mt-8 lg:pr-16 ">


        <div class="mb-2 lg:mb-4 md:mt-6 lg:mt-6 lg:mr-4">
            <a href="{{ route('posts.buscar') . '?category%5B%5D=1' }}">
                <img src="{{ Storage::url('Imagenes/Imagenes.jpg') }}"
                    class="inline-block w-10 h-10 ml-4 rounded-xl hover:scale-150 transition-all duration-100"
                    alt="...">
            </a>

            <a href="{{ route('posts.buscar') . '?category%5B%5D=3' }}">
                <img src="{{ Storage::url('Imagenes/Libros.jpg') }}"
                    class="inline-block h-10 w-10 object-cover object-center ml-4 rounded-xl hover:scale-150 transition-all duration-100"
                    alt="...">
            </a>
            <a href="{{ route('posts.buscar') . '?category%5B%5D=4' }}">
                <img src="{{ Storage::url('Imagenes/Videos.jpg') }}"
                    class="inline-block h-10 w-10 object-cover object-center ml-4 rounded-xl hover:scale-150 transition-all duration-100"
                    alt="...">
            </a>
            <a href="{{ route('posts.buscar') . '?category%5B%5D=2' }}">
                <img src="{{ Storage::url('Imagenes/Audios.jpg') }}"
                    class="inline-block h-10 w-10 object-cover object-center ml-4 rounded-xl hover:scale-150 transition-all duration-100"
                    alt="...">
            </a>
        </div>






        <div class=" md:flex-1 lg:flex-1 pl-0  ml-0">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <form action="{{ route('posts.buscar') }}">
                    <input type="search" name="textobuscar" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar imagenes, libros, audios, videos..." required>
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </form>
            </div>
        </div>







    </div>

    <div class="container my-4 px-6 mx-auto">
        <section>
            <div class="flex justify-center mt-14">
                <img src="{{ Storage::url('Imagenes/Titulo_ColeccionesDestacadas.png') }}"
                    class=" h-16 w-96 object-cover" alt="Titulo colecciones destacadas">
            </div>
            <hr>

            {{-- @livewire('destacada-posts')   --}}
            <livewire:destacada-posts lazy />

        </section>
    </div>


    <!--Multimedia publicada -->
    <div class="container my-4 px-6 mx-auto ">
        <section>
            <div class="flex justify-center">
                <img src="{{ Storage::url('Imagenes/Titulo_ArchivosRecientes.png') }}"
                    class="h-16 w-80 object-cover object-center" alt="Titulo archivos recientes">
            </div>
            <hr>
            @livewire('multimedia-publicada')


        </section>
    </div>
    <!--Hasta aqui -->
    <!--menu visible -->


    <div data-dial-init class="fixed end-6 bottom-6 group">
        <div id="speed-dial-menu-bottom-right" class="flex flex-col items-center hidden mb-4 space-y-2">
            <button type="button" data-tooltip-target="tooltip-share" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#20511f" d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>
                <span class="sr-only">Opción4</span>
            </button>
            <div id="tooltip-share" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Opción4
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-tooltip-target="tooltip-print" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#20511f" d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>
                <span class="sr-only">Opción3</span>
            </button>
            <div id="tooltip-print" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Opción3
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#20511f" d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>
                <span class="sr-only">Opción2</span>
            </button>
            <div id="tooltip-download" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Opción2
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-tooltip-target="tooltip-copy" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px]   rounded-full border shadow-sm  ">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#20511f" d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>
                <span class="sr-only"> Opción 1</span>
            </button>
            <div id="tooltip-copy" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Opción1
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
        <button type="button" data-dial-toggle="speed-dial-menu-bottom-right"
            aria-controls="speed-dial-menu-bottom-right" aria-expanded="false"
            class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>


    <!--Hasta aqui -->


    <!--flowbite -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}
    <script src="/vendor/flowbite/js/cdnjs.cloudflare.com_ajax_libs_flowbite_1.8.1_flowbite.min.js"></script>
    <!--hasta aqui -->
    <script>
        // const changeState= () =>{
        function changeState(idpost) {
            const split = idpost.split('-')
            const fas = document.getElementById(idpost);
            //me gusta
            if (split[0] == 'fas' || split[0] == 'fastc') {
                fas.classList.toggle('fa-regular');
                fas.classList.toggle('fa-thumbs-up');
                fas.classList.toggle('fa-lg');

                fas.classList.toggle('fa-solid');
                fas.classList.toggle('fa-thumbs-up');
                fas.classList.toggle('fa-lg');
            }
            // document.getElementById("fas").classList.add("fa-solid", "fa-thumbs-up", "fa-lg");
            //me encanta
            if (split[0] == 'encantaj' || split[0] == 'encantajtc') {
                fas.classList.toggle('fa-regular');
                fas.classList.toggle('fa-heart');
                fas.classList.toggle('fa-lg');

                fas.classList.toggle('fa-solid');
                fas.classList.toggle('fa-heart');
                fas.classList.toggle('fa-lg');
            }

            //compartir
            if (split[0] == 'compartirj' || split[0] == 'compartirjtc') {
                alert('Modulo en proceso de construccion');
            }

        }
    </script>

    @push('js')
        <script>
            // $(document).ready(() => {
            //     alert('prueba');
            //     const breakpoint = 500;
            //     $(window).scroll(() => toggleActionByBreakpoint(breakpoint));

            //     function toggleActionByBreakpoint(breakpoint) {
            //         const currentScrollPos = $(this).scrollTop();
            //         console.log(currentScrollPos);

            //         const isScrollOverPos = currentScrollPos > breakpoint;
            //         const isScrollUnderPos = currentScrollPos < breakpoint;

            //         // if (isScrollOverPos) $("body").css('background-color', 'green');
            //         // if (isScrollUnderPos) $("body").css('background-color', 'red');
            //         if (isScrollOverPos) alert('leo el mejor');
            //         if (isScrollUnderPos) alert('leo el mejor');
            //     }
            // });

            function myFunction() {
                const $content = document.getElementById('myInput');
                $content.select();
                document.execCommand('copy');
            }
        </script>
    @endpush

</x-app-layout>
