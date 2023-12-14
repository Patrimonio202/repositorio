<div class="z-index:-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        {{-- <h1 style="font-family:Raleway-ExtraBold" class="text-4xl font-blod text-black-600  mb-6 ">{{ $post->name }}
        </h1> --}}

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
                    <figure class="md:mr-12 lg:mr-12 mb-4">
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
                    <div class="card flex flex-col items-center text-xl font-mono p-4 rounded-md text-white aspect-[16/9] md:mr-12 lg:mr-12 mb-4"
                        style=" background-image: url({{ Storage::url('Imagenes/FondoReproductor.png') }})">
                        <div class="cover flex flex-col items-center min-w-80px w-auto max-w-880px">
                            <img src="{{ Storage::url($post->image->url) }}" alt="Album Cover" class="img-source w-3/6 rounded-xl" onclick="full_view(this);">
                            @section('ogImage', Storage::url($post->image->url))
                            <p class="-translate-y-10 w-3/6 text-center break-words"></p>
                        </div>
                        <audio id="song" class="block w-full max-w-md mx-auto mt-4" controls>
                            <source src="{{ Storage::url($post->image->urlarchivo) }}" type="audio/mpeg">
                        </audio>
                        <div class="hidden lg:block mt-4">
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
                    <figure class="md:mr-12 lg:mr-12 mb-4">

                        <div class="card flex flex-col items-center text-xl font-mono p-4 rounded-md text-white aspect-[16/9]  mb-4"
                            style=" background-image: url({{ Storage::url('Imagenes/Fondo_Publicaciones.png') }})">
                            <div class="cover flex flex-col items-center min-w-80px w-auto max-w-880px mt-10">

                                <img data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                                    src="{{ Storage::url($post->image->url) }}" alt="Album Cover"
                                    class="w-3/6 rounded-xl hover:scale-105 transition-all duration-100">

                                @section('ogImage', Storage::url($post->image->url))
                                <p class="-translate-y-10 w-3/6 text-center break-words"></p>
                            </div>

                        </div>

                    </figure>
                @endif

                @if ($post->category->id == 4)
                    <div class="md:mr-12 lg:mr-12 mb-4 relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg   "
                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                        <x-embed url="{{ $post->image->urlyoutube }}" aspect-ratio="4:3" />
                    </div>
                @endif

                <div class="flex ">
                    <div class=" lg:hidden mr-4">
                        <i class="fa-solid fa-bug" wire:click="$set('opene', true)"></i>
                    </div>

                    <div class="flex-1">
                        <small style="font-family:Raleway-Regular">Publicado el
                            {{ $post->created_at->format('Y-m-d') }}
                        </small>
                    </div>

                    <div class=" flex-1 items-center bg-center justify-center hidden lg:block">
                        <button wire:click="$set('opene', true)"
                         class=" text-xs bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                         <i class="fa-solid fa-bug" wire:click="$set('opene', true)"></i> Reportar un error
                          </button>
                    </div>

                    <div class="flex right-0 md:mr-14  lg:mr-14 gap-6 ">
                        <div class="flex-1" data-tooltip-target="tcompartir" data-tooltip-style="light">
                            <i wire:click="edit({{ $post }})" class="fa-solid fa-share fa-lg hover:text-[#00a2b0] hover:scale-125 transition-all duration-100"></i>
                        </div>
                        @auth
                            <div class="flex-1" data-tooltip-target="tmeinteresa" data-tooltip-style="light">
                                <i wire:click="meinteresa({{ $post->id }})"
                                    class=" @if ($post->userVotes) fa-solid fa-bookmark fa-lg  @else fa-regular fa-bookmark fa-lg  @endif hover:text-[#00a2b0] hover:scale-125 transition-all duration-100"></i>
                            </div>
                            <div lass="flex-1" data-tooltip-target="tmegusta" data-tooltip-style="light">
                                <i wire:click="megusta({{ $post->id }})"
                                    class="@if ($post->userVoteslike) fa-solid fa-heart fa-lg   @else fa-regular fa-heart fa-lg @endif    hover:text-rose-600  hover:scale-125 transition-all duration-100 "
                                    id="fastc-{{ $post->id }}"></i>
                            </div>
                            <div class="flex-1" data-tooltip-target="tdescargar" data-tooltip-style="light">
                                <i wire:click="download({{ $post }})" class="  fa-solid fa-download fa-lg hover:text-[#00a2b0] hover:scale-125 transition-all duration-100" ></i>
                            </div>                           
                        @else
                            <div class="flex-1">
                                <a data-tooltip-target="tmeinteresa" data-tooltip-style="light"
                                    href="{{ route('login') }}">
                                    <i class="fa-regular fa-bookmark fa-lg hover:text-[#00a2b0] hover:scale-125 transition-all duration-100"></i>
                                </a>
                            </div>
                            <div class="flex-1 ">
                                <a data-tooltip-target="tmegusta" data-tooltip-style="light" href="{{ route('login') }}">
                                    <i class="fa-regular fa-heart  fa-lg   hover:text-rose-600 hover:scale-125 transition-all duration-100"></i>
                                </a>
                            </div>
                            <div class="flex-1">
                                <a data-tooltip-target="tdescargar" data-tooltip-style="light" href="{{ route('login') }}">
                                    <i class="fa-solid fa-download fa-lg hover:text-[#00a2b0] hover:scale-125 transition-all duration-100"></i>
                                </a>
                            </div>

                        @endauth


                    </div>

                </div>


                <div class="  bg-white pl-4 pr-4 lg:pl-14 pt-8 rounded-xl shadow-lg md:mr-12 lg:mr-12 mt-4 ">
                    <h1 style="font-family:Raleway-ExtraBold" class=" text-xs font-blod text-black-600   ">
                        {{ $post->name }}
                    </h1>
                    <div style="font-family:Raleway-Regular" class="  text-justify text-xs">
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
                </div>


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
                        <div style="font-family:Raleway-Regular"
                            class="mx-4 flex items-center h-14  rounded-lg  bg-gray-200 pl-4  ">
                            <i class="fa-solid fa-calendar-days fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4 text-xs "> Año creación:</p>
                            <p style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->anocreacion }}</p>
                        </div>
                        <div style="font-family:Raleway-Regular" class="mx-4 flex items-center py-4 pl-4 h-14">
                            <i class="fa-solid fa-user-tie fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4 text-xs ">Autor:</p>
                            <p style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->autor }}</p>
                        </div>

                        <div style="font-family:Raleway-Regular"
                            class="mx-4 flex items-center pb-4 rounded-lg bg-gray-200 h-14 pl-4 pt-4">
                            <i class="fa-solid fa-turn-up fa-lg"></i>
                            <p style="font-family:Raleway-ExtraBold" class="ml-4 text-xs ">Categoría:</p>
                            <p style="font-family:Raleway-Regular" class="mx-4 text-xs">{{ $post->category->name }}
                            </p>
                        </div>

                        <div class="mx-4 flex items-center pb-4 pl-4 h-14">
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
                                    <div
                                        class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg  ">
                                        <x-embed url="{{ $similar->image->urlyoutube }}" />
                                    </div>
                                    <a href="{{ route('posts.show', $similar) }}">
                                        <div>
                                            <p style="font-family:Raleway-ExtraBold"
                                                class=" ml-2 text-justify text-xs font-semibold">{{ $similar->name }}
                                            </p>
                                            <p style="font-family:Raleway-Regular" class="text-xs ml-2 ">
                                                {{ $similar->autor }}</p>
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
                                        <p style="font-family:Raleway-ExtraBold"
                                            class=" ml-4 text-justify text-xs font-semibold">{{ $similar->name }}</p>
                                        <p style="font-family:Raleway-Regular" class="text-xs ml-4 ">
                                            {{ $similar->autor }}</p>
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


    {{-- prueba de modal  sm md lg  xl 2xl --}}
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            Compartir
        </x-slot>

        <x-slot name="content">
            <div class=" flex mb-8 justify-center items-center ">
                <div class="flex mr-6">
                    <div class="text-center">
                        <a class=" focus:outline-none" href="https://api.whatsapp.com/send?text={{ $post_slug }}"
                            target="_blank" rel="noopener noreferrer">

                            <img src="{{ Storage::url('Imagenes/WhatsApp.png') }}" alt="Logo WhatsApp"
                                class=" object-cover w-16 h-16 hover:scale-110 transition-all duration-100" />
                            <small>WhatsApp</small>
                        </a>

                    </div>
                </div>
                <div class="flex mr-6">
                    <div class="text-center">
                        <a class=" focus:outline-none"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ $post_slug }}" target="_blank"
                            rel="noopener noreferrer">
                            <img src="{{ Storage::url('Imagenes/Facebook.png') }}" alt="Slack Logo"
                                class=" object-cover h-16  w-16 hover:scale-110 transition-all duration-100" />
                            <small>Facebook</small>
                        </a>
                    </div>
                </div>

                <div class="flex ">
                    <div class="text-center">
                        <a class=" focus:outline-none"
                            href="https://twitter.com/intent/tweet?text=&url={{ $post_slug }}&hashtags=repositoriovirtual"
                            target="_blank" rel="noopener noreferrer">
                            <img src="{{ Storage::url('Imagenes/X.webp') }}" alt="Slack Logo"
                                class=" object-cover h-16  w-16 hover:scale-110 transition-all duration-100" />
                            <small>Twitter</small>
                        </a>
                    </div>
                </div>

                
            </div>

            <div class="flex items-center">
                <x-input id="myInput"   class=" w-full  px-2 h-7 mr-4" value="{{ $post_slug }}"> </x-input>              
                <i class="fa-regular fa-copy fa-lg" onclick="myFunction()"></i>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>

    </x-dialog-modal>
    <!-- Tooltip -->
    <div id="tcompartir" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
        Compartir
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div id="tmeinteresa" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
        Guardar
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div id="tmegusta" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
        Me gusta
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div id="tdescargar" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
        Descargar
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <!-- modal visor de informacion-->




    <!-- Extra Large Modal solo para publicaciones-->
    @if ($post->category->id == 3)
        <div id="extralarge-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full  p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            {{ $post->name }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="extralarge-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="lg:p-4 md:p-5 lg:space-y-4  ">
                        {{-- <iframe width="100%" height="700"
                        src="{{ Storage::url($post->image->urlarchivo) }}#toolbar=0&navpanes=0&scrollbar=0">
                        </iframe> --}}
                        {{-- <object data="{{ Storage::url($post->image->urlarchivo) }}" type="application/pdf"
                            frameborder="0" width="100%" height="600px" style="padding: 20px;">                          
                                <iframe class=" w-full" height="600px" src="pdfjs/web/viewer.html?file={{ Storage::url($post->image->urlarchivo) }}" frameborder="0"></iframe>
                        </object> --}}

                         <iframe class=" w-full" height="600px" src="{{ asset('pdfjs/web/viewer.html')}}?file=http://patrimonioelsantuario.gov.co/{{$post->image->urlarchivo}}" frameborder="0"></iframe>

                    </div>

                </div>
            </div>
        </div>
    @endif


    <!-- Modal para enviar errores    sm md lg  xl 2xl-->
    <x-dialog-modal wire:model="opene" maxWidth="md">
        <x-slot name="title">
            Reportar error
            <hr>
        </x-slot>

        <x-slot name="content">
            <div >
                <x-label>Descripción del error </x-label>
                <textarea wire:model="mensaje"  rows="6"
                        class=" pl-4 pt-2  border-blue-600 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full "
                        placeholder="Detalle el error que quiere reportar o notifique posibles violaciones a los derechos de autor." ></textarea>                
            </div>    
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class=" mr-4" wire:click="$set('opene',false)">
                Cancelar
            </x-secondary-button>
            <x-danger-button wire:click.prevent="enviarmensaje({{ $post }})">
                Enviar
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>
    <!-- Tooltip -->

</div>
