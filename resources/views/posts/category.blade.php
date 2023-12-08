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
                <form action="{{  route('posts.category', $category->slug) }}">
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
                    @if ($category->id=='2')   
                        <div class="mb-4">
                            <p class="text-lg font-semibold">Autor:</p>
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

                    <x-button class="mb-4">
                        Aplicar filtros
                    </x-button>

                </form>
            </div>
            <div class=" col-span-3">
                @livewire('categorylw', ['category' => $category,'datos'=> request()->all() ])
            </div>
        </div>


    </div>





</x-app-layout>
