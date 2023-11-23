<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <h1 style="font-family:Raleway-ExtraBold" class="text-4xl font-blod text-black-600  mb-6 ">{{ $post->name }}</h1>

        @section('ogTitle', $post->name)
        @section('title', $post->name)
        @section('ogUrl', Request::fullUrl())
        {{-- <div class="text-lg text-gray-500 mb-2">
            {!! $post->body !!}
        </div> --}}

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- contenido principal --}}


            <!-- Image Viewer -->
            <div id="img-viewer">
                <span class="close" onclick="close_model()">&times;</span>
                <img class="modal-content rounded-xl zoom" id="full-image">
            </div>

            <div class="lg:col-span-2">
                {{-- aqui organizamos la imagen --}}
                @if ($post->category->id == 1)
                    <figure class="md:mr-12 lg:mr-12 mb-4" >
                        @if ($post->image)
                            <img class="img-source zoom rounded-xl hover:scale-105 transition-all duration-100 cursor-pointer  object-cover object-top hover:mb-2 "
                                src="{{ Storage::url($post->image->url) }}" alt="" onclick="full_view(this);">
                            @section('ogImage', Storage::url($post->image->url))
                        @else
                            <img class="w-full h-80 object-cover object-center"
                                src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                                alt="">
                        @endif
                    </figure>
                @endif
                @if ($post->category->id == 2)
                    <div
                        class="card flex flex-col items-center bg-gradient-to-tr from-blue-400 to-red-400 text-xl font-mono p-4 rounded-md text-white aspect-[16/9]">
                        <div class="cover flex flex-col items-center min-w-80px w-auto max-w-880px">
                            <img src="{{ Storage::url($post->image->url) }}" alt="Album Cover" class="w-3/6 rounded-xl">
                            @section('ogImage', Storage::url($post->image->url))
                            <p class="-translate-y-10 w-3/6 text-center break-words"></p>
                        </div>
                        <audio id="song" class="block w-full max-w-md mx-auto" controls>
                            <source src="{{ Storage::url($post->image->urlarchivo) }}" type="audio/mpeg">
                        </audio>
                        <div class="mt-4">
                            <button onclick="document.getElementById('song').play()"
                                class="bg-slate-600 px-2 rounded-lg hover:bg-slate-800">Reproducir</button>
                            <button onclick="document.getElementById('song').pause()"
                                class="bg-slate-600 px-2 rounded-lg hover:bg-slate-800">Pausar</button>
                            <button onclick="document.getElementById('song').volume += 0.1"
                                class="bg-slate-600 px-2 rounded-lg hover:bg-slate-800">Vol +</button>
                            <button onclick="document.getElementById('song').volume -= 0.1"
                                class="bg-slate-600 px-2 rounded-lg hover:bg-slate-800">Vol -</button>
                        </div>
                    </div>
                @endif

                @if ($post->category->id == 3)
                    <figure>
                        <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg  "
                            data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <iframe width="100%" height="1000"
                                src="{{ Storage::url($post->image->urlarchivo) }}#toolbar=0&navpanes=0&scrollbar=0"></iframe>
                            @section('ogImage', Storage::url($post->image->url))
                            {{-- <embed src="{{ Storage::url('archivos/CP-510-47-994000022586-0.PDF') }}" type="application/pdf" width="100%" height="500px" /> --}}
                            {{-- <embed
                                src="{{ Storage::url('archivos/CP-510-47-994000022586-0.PDF') }}#toolbar=0&navpanes=0&scrollbar=0"
                                type="application/pdf" width="100%" height="500px" /> --}}
                            <div>
                    </figure>
                @endif

                @if ($post->category->id == 4)
                    <div class="lg:mt-8 lg:mr-12 lg:ml-12 relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg  "
                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                        <x-embed url="{{ $post->image->urlyoutube }}" aspect-ratio="4:3" />
                    </div>
                @endif
                <small  style="font-family:Raleway-Regular">Publicado el
                    {{ $post->created_at->format('Y-m-d') }}
                </small>
                <div style="font-family:Raleway-Regular" class=" mt-4 text-justify text-xs">
                    {!! $post->body !!}
                    @section('ogDesc', strip_tags($post->body))
                </div>

                {{-- etiquetas --}}
                <div style="font-family:Raleway-Regular" class="pt-4 pb-8 ">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('posts.tag', $tag) }}"
                            class="inline-block bg-{{ $tag->color }}-200 rounded-full px-3 py-1 text-xs text-gray-700 mr-2">{{ $tag->name }}</a>
                    @endforeach
                </div>

                <hr>

            </div>



            {{-- Contenido relacionado --}}
            <aside>
                <div class="card bg-white rounded-xl shadow-lg hover:scale-105 transition-all duration-100">
                    <div class="card-body mb-4 ">
                        <div class="py-2">
                            <h1 style="font-family:Raleway-ExtraBold" class="text-2xl leading-8 text-center   py-2 ">
                                Ficha técnica
                            </h1>

                        </div>
                        <div style="font-family:Raleway-Regular" class="mx-4 flex items-center h-14  rounded-lg  bg-gray-200 pl-4  ">
                            <i class="fa-solid fa-calendar-days fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4 text-xs "> Año creación:</p>
                            <p  style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->anocreacion }}</p>
                        </div>
                        <div style="font-family:Raleway-Regular" class="mx-4 flex items-center py-4 pl-4 h-14">
                            <i class="fa-solid fa-user-tie fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4 text-xs ">Autor:</p>
                            <p style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->autor }}</p>
                        </div>

                        <div style="font-family:Raleway-Regular" class="mx-4 flex items-center pb-4 rounded-lg bg-gray-200 h-14 pl-4 pt-4">
                            <i class="fa-solid fa-turn-up fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4 text-xs ">Categoría:</p>
                            <p style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->category->name }}</p>
                        </div>

                        <div  class="mx-4 flex items-center pb-4 pl-4 h-14">
                            <i class="fa-solid fa-folder-plus fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4  text-xs">Tema:</p>
                            <p style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->tema->name }}</p>
                        </div>
                    </div>
                </div>

              
                <h1 style="font-family:Raleway-ExtraBold" class="text-xs ">Mas en {{ $post->category->name }}</h1>
                <hr class="py-1 mb-4">
                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-8">
                            @if ($similar->category->id == '4')
                                <div class="grid grid-cols-2">
                                    <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg  "   >
                                        <x-embed  url="{{ $similar->image->urlyoutube }}"  />
                                    </div>
                                    <a href="{{ route('posts.show', $similar) }}">
                                        <div>
                                            <p style="font-family:Raleway-ExtraBold" class=" ml-2 text-justify text-xs font-semibold">{{ $similar->name }}
                                            </p>
                                            <p style="font-family:Raleway-Regular" class="text-xs ml-2 ">{{ $similar->autor }}</p>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <a class="flex" href="{{ route('posts.show', $similar) }}">
                                    @if ($similar->image)
                                        <img class="w-36 h-20 object-cover object-top rounded-xl px-2 hover:scale-105 transition-all duration-100 "
                                            src="{{ Storage::url($similar->image->url) }}" alt="">
                                    @endif


                                    <div class="flex-1">
                                        <p style="font-family:Raleway-ExtraBold" class=" ml-4 text-justify text-xs font-semibold">{{ $similar->name }}</p>
                                        <p style="font-family:Raleway-Regular" class="text-xs ml-4 ">{{ $similar->autor }}</p>
                                    </div>
                                </a>
                            @endif

                        </li>
                    @endforeach
                </ul>

            </aside>
            <div class="mt-6 lg:col-span-2">
                @livewire('question', ['model' => $post])
            </div>
        </div>

    </div>


    @push('js')
        <script src="{{ asset('vendor/wheelzoom/wheelzoom.js') }}"></script>
        <script>
            wheelzoom(document.querySelector('img.zoom'));

            function full_view(ele) {
                //     // alert('leo el mejor');            
                let src = ele.parentElement.querySelector(".img-source").getAttribute("src");

                document.querySelector("#img-viewer").querySelector("img").setAttribute("src", src);
                document.querySelector("#img-viewer").style.display = "block";
            }

            function close_model() {
                document.querySelector("#img-viewer").style.display = "none";
            }
        </script>
    @endpush
</x-app-layout>
