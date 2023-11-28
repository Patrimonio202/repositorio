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
                <img src="{{ Storage::url('Imagenes/Titulo_ColeccionesDestacadas.png') }}" class=" h-20 w-80 object-cover"
                alt="Titulo archivos recientes">
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
                <img src="{{ Storage::url('Imagenes/Titulo_ArchivosRecientes.png') }}" class="h-20 w-80 object-cover object-center"
                alt="Titulo archivos recientes">
            </div>
            <hr>
            @livewire('multimedia-publicada')


        </section>
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
            // Livewire.on('glider', ()=> { 
            //  document.addEventListener('DOMContentLoaded', () => {           
            new Glider(document.querySelector('.glider'), {
                slidesToShow: 1,
                slidesToScroll: 1,
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
                responsive: [{
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 2.5,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3.5,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3.5,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1280,
                        settings: {
                            slidesToShow: 3.5,
                            slidesToScroll: 3,
                        }
                    },
                ]
            });

            // });
        </script>
    @endpush

</x-app-layout>
