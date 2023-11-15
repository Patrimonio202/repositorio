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
                            <img src="{{ Storage::url($post->image->url) }}" class=" w-full h-full lg:h-60 object-cover object-center"/>
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                                    style="background-color: rgba(251, 251, 251, 0.15)"></div>
                            </a>
                        </div>
                    </figure>
                @endif
                <div class="p-6">
                    <div class=" text-center">
                        <h1 class=" text-center text-lg font-semibold">
                            <a href="">{{ Str::limit($post->name, 40) }}</a>
                        </h1>

                        <p class="text-gray-500 mb-4">
                            <a href="{{ route('posts.category', $post->category->slug) }}">
                                <img src="{{ Storage::url('Imagenes/' . $post->category->rutaimagen) }}"
                                    class="inline-block w-5 h-5 rounded-xl" alt="...">
                            </a>
                            <small>Creado en <u>{{ $post->anocreacion }}</u> por
                                <a href="" class="text-gray-900">{{ $post->autor }}</a></small>
                        </p>
                    </div>
                    <div class="mb-8 pb-2 ">
                        {!! Str::limit($post->body, 100) !!} <a class="font-bold text-blue-600 no-underline hover:underline"
                            href="{{ route('posts.show', $post) }}">Leer mas</a>
                    </div>
                </div>

                <div class="absolute bottom-5 right-0 px-6 ">
                    <i wire:click="edit({{ $post }})" class="fa-solid fa-share-nodes fa-lg"></i>
                    @auth
                        <i wire:click="meinteresa({{ $post->id }})"
                            class=" @if ($post->userVotes) fa-solid fa-heart fa-lg @else fa-regular fa-heart fa-lg @endif"></i>

                        <i wire:click="megusta({{ $post->id }})"
                            class="@if ($post->userVoteslike) fa-solid fa-thumbs-up fa-lg @else fa-regular fa-thumbs-up fa-lg @endif "
                            id="fastc-{{ $post->id }}"></i>
                    @else
                    <a href="{{ route('login') }}">
                         <i class="fa-solid fa-right-to-bracket fa-lg"></i>
                     </a>
                    @endauth
                </div>
            </article>
        @endforeach
        <div x-intersect="$wire.loadMore()"></div>
    </div>
    @if ($posts_per_page >= $totalRecords)
        <h1 class=" text-center text-lg  font-semibold text-gray-700 ">
            No hay mas registros...
        </h1>
    @endif

    {{-- prueba de modal  sm md lg  xl 2xl --}}
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            Compartir
        </x-slot>

        <x-slot name="content" >            
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
                            href="https://twitter.com/intent/tweet?text=&url={{$post_slug}}&hashtags=repositoriovirtual" target="_blank"
                            rel="noopener noreferrer">
                            <img src="{{ Storage::url('Imagenes/X.webp') }}" alt="Slack Logo"
                                class=" object-cover h-16  w-16 hover:scale-110 transition-all duration-100" />
                            <small>Twitter</small>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center">
                <x-input id="myInput" disabled class=" w-full  px-2 h-7 mr-4" value="{{ $post_slug }}"> </x-input>
               <i class="fa-regular fa-copy fa-lg" onclick="myFunction()"></i>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>

    </x-dialog-modal>
</div>
