<x-app-layout>
    <div class="max-w-7xl lg:mx-auto mx-4">
        @Switch($tag->slug)
            @case('archivo-antonio-botero')
                <x-colecciones-antoniobotero />
            @break

            @case('archivo-el-santuariano')
                <x-colecciones-elsantuariano />
            @break

            @case('archivo-patrimonial-de-el-santuario')
                <x-colecciones-archivopatrimonialelsantuario />
            @break

            @case('biblioteca-publica-municipal')
                <x-colecciones-biblioteca />
            @break

            @default
                <span>en desarrollo {{ $tag->name }}</span>
        @endswitch
        <div class=" grid grid-cols-1  md:grid-cols-4 lg:grid-cols-4">
            <div class="mt-4">
                <form action="{{ route('posts.colecciones', $tag->slug) }}">
                    <div class="ui-widget mb-4">
                        <p class="text-lg font-semibold">Panel de búsqueda:</p>
                    </div>

                    @if ($tag->slug == 'archivo-patrimonial-de-el-santuario')
                        <div class="mb-4">
                            <p class="text-lg font-semibold">Formato:</p>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <label>
                                            <x-checkbox type="checkbox" name="categorias[]" value="{{ $category->id }}"
                                                :checked="is_array(request('categorias')) &&
                                                    in_array($category->id, request('categorias'))" />
                                            <span class="ml-2 text-gray-700">{{ $category->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    @if ($tag->slug == 'archivo-patrimonial-de-el-santuario' || $tag->slug == 'biblioteca-publica-municipal')
                        <div class="mb-4">
                            <p class="text-lg font-semibold">
                                @if ($tag->slug == 'archivo-patrimonial-de-el-santuario')
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

                    @if ($tag->slug == 'archivo-patrimonial-de-el-santuario' || $tag->slug == 'biblioteca-publica-municipal')
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
                    @endif

                    @if ($tag->slug == 'archivo-antonio-botero')
                        <div class="mb-4">
                            <p class="text-lg font-semibold">Subcategorias:</p>
                            <ul>
                                @foreach ($subcategories as $subcategory)
                                    <li>
                                        <label>
                                            <x-checkbox type="checkbox" name="subcategorias[]"
                                                value="{{ $subcategory->id }}" :checked="is_array(request('subcategorias')) &&
                                                    in_array($subcategory->id, request('subcategorias'))" />
                                            <span class="ml-2 text-gray-700">{{ $subcategory->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    @if ($tag->slug == 'archivo-el-santuariano' || $tag->slug == 'archivo-patrimonial-de-el-santuario' || $tag->slug == 'biblioteca-publica-municipal')
                        <div class="ui-widget mb-4">
                            <p class="text-lg font-semibold">Desde:</p>

                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <input name="fdesde" value="{{ request('fdesde') }}T00:00:00" type="datetime-local"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Seleccionar la fecha">
                            </div>
                        </div>

                        <div class="ui-widget mb-4">
                            <p class="text-lg font-semibold">Hasta:</p>

                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <input name="fhasta" value="{{ request('fhasta') }}T00:00:00" type="datetime-local"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Seleccionar la fecha">
                            </div>
                        </div>
                    @endif



                    <x-button class="mb-4">
                        Aplicar filtros
                    </x-button>

                </form>
            </div>
            <div class=" col-span-3">
                @livewire('taglw', ['tag' => $tag, 'datos' => request()->all()])
            </div>
        </div>



    </div>

    @push('js')
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
