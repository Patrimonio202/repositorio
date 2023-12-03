<x-app-layout>
    <!-- Image Viewer x-on:resize.window="isMobile = (window.innerWidth < 1024) ? false : true" -->
    <div id="img-viewer">
        <span class="close" onclick="close_model()">&times;</span>
        <img class="modal-content rounded-xl zoom" id="full-image">
    </div>

    <div x-data="dropdown" class="container my-4 px-6 mx-auto ">
        {{-- <figure class="mb-12">
            <img src="{{ Storage::url('Imagenes/Imagen-barner-2.jpg') }}" alt="Portada del home"
                class="w-full h-40 object-cover object-center" >
        </figure> --}}

        <div class="mx-4 ">
            <button
                class=" lg:hidden   text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                x-on:click="toggle" >
                <label x-text="mensaje">Mostrar opciones de búsqueda</label>
            </button>
        </div>

        <section>

            <div class="grid grid-cols-1 lg:grid-cols-4 mt-4  lg:mt-16">

                <!-- panel de busqueda -->
                <div x-show="isMobile" class="col-span-1  md:col-span-1  lg:col-span-1 mr-4">
                    <form action="{{ route('posts.buscar') }}">
                        <div class="ui-widget mb-4">
                            <p class="text-lg font-semibold">Criterio de búsqueda:</p>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full ui-autocomplete-input"
                                id="search" value="{{ request('textobuscar') }}" name="textobuscar" type="text"
                                placeholder="Palabra clave" autocomplete="off">

                        </div>

                        <div class="mb-4">
                            <p class="text-lg font-semibold">Ordenar:</p>
                            <select name="order"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                                <option value="new">Más nuevos</option>
                                <option value="old" @selected(request('order') == 'old')>Más antiguos</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <p class="text-lg font-semibold">Categorias:</p>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <label>
                                            <x-checkbox type="checkbox" name="category[]" value="{{ $category->id }}"
                                                :checked="is_array(request('category')) &&
                                                    in_array($category->id, request('category'))" />
                                            <span class="ml-2 text-gray-700">{{ $category->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

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

                        <x-button class="mb-4">
                            Aplicar filtros
                        </x-button>

                    </form>
                </div>

                <div class="col-span-1 lg:col-span-3 ">


                    <div class="space-y-4">
                        @foreach ($posts as $post)
                            <article class="grid grid-cols-1  lg:grid-cols-2 gap-6">
                                @if ($post->category_id == '4')
                                    <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4  "
                                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                                        <x-embed url="{{ $post->image->urlyoutube }}" />
                                    </div>
                                @else
                                    <figure>
                                        <img class=" object-cover object-top img-source h-72 w-full rounded-xl hover:blur-sm cursor-pointer"
                                            src="{{ Storage::url($post->image->url) }}" alt="{{ $post->name }}"
                                            onclick="full_view(this);">
                                    </figure>
                                @endif

                                <div>
                                    <h1 class="text-xl font-semibold">
                                        {{ $post->name }}
                                    </h1>
                                    <hr class="mt-1 mb-2">
                                    <div class="mb-2">
                                        <img src="{{ Storage::url('Imagenes/' . $post->category->rutaimagen) }}"
                                            class="inline-block w-5 h-5 " alt="...">

                                        @foreach ($post->tags as $tag)
                                            <a href="{{ route('posts.buscar') . '?tag=' . $tag->name }}">
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                    {{ $tag->name }}
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>

                                    <p class="text-sm mb-2">
                                        {{ $post->created_at->format('d M Y') }}
                                    </p>

                                    <div class="mb-4">
                                        {!! Str::limit($post->body, 200, '...') !!}
                                    </div>
                                    <div>
                                        <a href="{{ route('posts.show', $post) }}"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Leer más
                                        </a>
                                    </div>
                                </div>

                            </article>
                        @endforeach
                    </div>
                </div>
            </div>


        </section>


    </div>

    @push('js')
        <script src="{{ asset('vendor/wheelzoom/wheelzoom.js') }}"></script>
        <script>
            wheelzoom(document.querySelector('img.zoom'));

            function full_view(ele) {
                let src = ele.parentElement.querySelector(".img-source").getAttribute("src");

                document.querySelector("#img-viewer").querySelector("img").setAttribute("src", src);
                document.querySelector("#img-viewer").style.display = "block";
            }

            function close_model() {
                document.querySelector("#img-viewer").style.display = "none";
            }
        </script>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('dropdown', () => ({
                    //isMobile: false,
                    isMobile: (window.innerWidth < 1024) ? false : true,
                    mensaje:'Mostrar opciones de búsqueda',


                    toggle() {
                        if(this.isMobile)
                        this.mensaje='Mostrar opciones de búsqueda'
                        else
                        this.mensaje='Ocultar opciones de búsqueda';
                        
                        this.isMobile = !this.isMobile
                    }
                }))
            })
        </script>
    @endpush

</x-app-layout>
