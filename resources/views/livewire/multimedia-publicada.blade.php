<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  my-2 -mr-4  ">
        @foreach ($posts as $post)
            <article class=" relative bg-white  rounded-xl mr-4 md:mx-8 lg:mx-8  my-10  ">
                @if ($post->category_id == '4')
                    <figure>
                        <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4 "
                            data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <x-embed url="{{ $post->image->urlyoutube }}" />
                        </div>

                    </figure>
                @else
                    <figure>
                        <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                            data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <img src="{{ Storage::url($post->image->url) }}"
                                class="w-full h-full md:h-60 lg:h-60 object-cover object-center lg:object-top md:object-top " />
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                                    style="background-color: rgba(251, 251, 251, 0.15)"></div>
                            </a>
                        </div>
                    </figure>
                @endif
                <div class="p-6">
                    <div class=" text-center">
                        <h1 style="font-family:Raleway-ExtraBold" class=" text-center text-xs ">
                            <a href="{{ route('posts.show', $post) }}">{{ Str::limit($post->name, 40) }}</a>
                        </h1>

                        <p style="font-family:Raleway-Regular" class="text-gray-500 mb-4 text-xs">
                            <a href="{{ route('posts.category', $post->category->slug) }}">
                                <img src="{{ Storage::url('Imagenes/' . $post->category->rutaimagen) }}"
                                    class="inline-block w-5 h-5 " alt="...">
                            </a>
                            <small>Creado en <u>{{ $post->anocreacion }}</u> por
                                <a href="" class="text-gray-900">{{ $post->autor }}</a></small>
                        </p>
                    </div>
                    <div  style="font-family:Raleway-Regular" class="mb-8 pb-2 text-xs text-justify">
                        {!! Str::limit($post->body, 100) !!} <a class="font-bold text-blue-600 no-underline hover:underline"
                            href="{{ route('posts.show', $post) }}">Leer mas</a>
                    </div>
                </div>

                <div class="flex absolute bottom-5 right-0 px-6 gap-6 ">
                    <div class="flex-1" data-tooltip-target="tcompartir" data-tooltip-style="light">
                        <i wire:click="edit({{ $post }})" class="fa-solid fa-share fa-lg hover:text-[#08416b]"></i>
                    </div>
                    @auth
                        <div class="flex-1" data-tooltip-target="tmeinteresa" data-tooltip-style="light" >
                            <i  wire:click="meinteresa({{ $post->id }})"
                                class=" @if ($post->userVotes) fa-solid fa-bookmark fa-lg @else fa-regular fa-bookmark fa-lg @endif hover:text-[#08416b]"></i>
                        </div>
                        <div lass="flex-1" data-tooltip-target="tmegusta" data-tooltip-style="light">
                            <i wire:click="megusta({{ $post->id }})"
                                class="@if ($post->userVoteslike) fa-solid fa-heart fa-lg @else fa-regular fa-heart fa-lg @endif  hover:text-rose-600 "
                                id="fastc-{{ $post->id }}"></i>
                        </div>
                        <div class="flex-1" data-tooltip-target="tdescargar" data-tooltip-style="light" >                              
                            <i wire:click="download({{ $post }})" class="fa-solid fa-download fa-lg hover:text-[#08416b]"></i>                                
                        </div>
                    @else
                        <div class="flex-1">
                            <a data-tooltip-target="tmeinteresa" data-tooltip-style="light" href="{{ route('login') }}">
                                <i class="fa-regular fa-bookmark fa-lg hover:text-[#08416b]"></i>
                            </a>
                        </div>
                        <div class="flex-1">
                            <a data-tooltip-target="tmegusta" data-tooltip-style="light" href="{{ route('login') }}">
                                <i class="fa-regular fa-heart  fa-lg  hover:text-rose-600"></i>
                            </a>
                        </div>
                        <div class="flex-1">
                            <a data-tooltip-target="tdescargar" data-tooltip-style="light" href="{{ route('login') }}">
                                <i class="fa-solid fa-download fa-lg hover:text-[#08416b]"></i>
                            </a>
                        </div>

                    @endauth


                </div>
            </article>
        @endforeach
       
    </div>
    <div class="col-span-3"  x-intersect="$wire.loadMore()">
        <div class=" justify-center" wire:loading.flex>
            <div role="status">
                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class=" ml-4">Cargando...</span>
            </div>
        </div>
    </div>
    @if ($posts_per_page >= $totalRecords)
         {{-- <h1 class=" text-center text-lg  font-semibold text-gray-700 ">
            No hay mas registros...
        </h1>  --}}
    @endif

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

                <div class="flex">
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
</div>
