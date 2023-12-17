<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @switch($category->id)
            @case(1)
                <div class=" mb-8">
                    <img src="{{ Storage::url('Imagenes/TituloImagenes.png') }}" class="inline-block  rounded-lg  shadow-lg "
                        alt="Titulo imagenes">
                </div>
            @break

            @case(2)
                <div class=" mb-8">
                    <img src="{{ Storage::url('Imagenes/TituloAudios.png') }}" class="inline-block  rounded-lg  shadow-lg "
                        alt="Titulo Audios">
                </div>
            @break

            @case(3)
                <div class=" mb-8">
                    <img src="{{ Storage::url('Imagenes/TituloPublicaciones.png') }}"
                        class="inline-block  rounded-lg shadow-lg  " alt="Titulo Publicaciones">
                </div>
            @break

            @case(4)
                <div class=" mb-8">
                    <img src="{{ Storage::url('Imagenes/TituloVideos.png') }}" class="inline-block  rounded-lg  shadow-lg"
                        alt="Titulo videos">
                </div>
            @break

            @default
        @endswitch


        <div class=" grid grid-cols-1  md:grid-cols-4 lg:grid-cols-4">
            <div class="mt-4">
                <form action="{{ route('posts.category', $category->slug) }}">
                    <div class="ui-widget mb-4">
                        <p class="text-lg font-semibold">Panel de búsqueda:</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold">Colecciones:</p>
                        <ul>
                            @foreach ($tags as $tag)
                                <li>
                                    <label>
                                        <x-checkbox type="checkbox" name="colecciones[]" value="{{ $tag->id }}"
                                            :checked="is_array(request('colecciones')) &&
                                                in_array($tag->id, request('colecciones'))" />
                                        <span class="ml-2 text-gray-700">{{ $tag->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-semibold">Temas:</p>
                        <ul>
                            @foreach ($temas as $tema)
                                <li>
                                    <label>
                                        <x-checkbox type="checkbox" name="temas[]" value="{{ $tema->id }}"
                                            :checked="is_array(request('temas')) &&
                                                in_array($tema->id, request('temas'))" />
                                        <span class="ml-2 text-gray-700">{{ $tema->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    @if ($category->id == '2' || $category->id == '3')
                        <div class="mb-4">
                            <p class="text-lg font-semibold">
                                @if ($category->id == '2')
                                    Artistas:
                                @else
                                    Autores:
                                @endif
                            </p>
                            <ul>
                                @foreach ($autores as $autor)
                                    <li>
                                        <label>
                                            <x-checkbox type="checkbox" name="autores[]" value="{{ $autor->autor }}"
                                                :checked="is_array(request('autores')) &&
                                                    in_array($autor->autor, request('autores'))" />
                                            <span class="ml-2 text-gray-700">{{ $autor->autor }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    <div class="ui-widget mb-4">
                        <p class="text-lg font-semibold">Desde:</p>

                        <div  class="relative max-w-sm">
                            <div  class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none" >
                                <i class="fa-solid fa-calendar-days"></i>
                             </div>
                            <input name="fdesde" value="{{ request('fdesde') }}T00:00:00"  type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Seleccionar la fecha">
                        </div>
                    </div>

                    <div class="ui-widget mb-4">
                        <p class="text-lg font-semibold">Hasta:</p>

                        <div  class="relative max-w-sm">
                            <div  class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none" >
                                <i class="fa-solid fa-calendar-days"></i>
                             </div>
                            <input name="fhasta" value="{{ request('fhasta') }}T00:00:00"  type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Seleccionar la fecha">
                        </div>
                    </div>



                    <x-button class="mb-4">
                        Aplicar filtros
                    </x-button>

                </form>
            </div>
            <div class=" col-span-3">
                @livewire('categorylw', ['category' => $category, 'datos' => request()->all()])
            </div>
        </div>


    </div>


    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
        <script>
            const datepickerEl = document.getElementById('datepickerId');
            Object.assign(Datepicker.locales, es);
            new Datepicker(datepickerEl, {
                // options
                language: 'es',
            });
        </script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


        <script>
            //flatpickr("input[type=datetime-local]");
            config = {
                enableTime: false,
                dateFormat: 'Y-m-d',
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                
            }
            flatpickr("input[type=datetime-local]", config);
        </script>
    @endpush


</x-app-layout>
