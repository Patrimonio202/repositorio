<div>    

    @if ($posts->count() == 0)
        <section class="max-w-lg px-4 py-12 mx-auto">
            <img class="mx-auto sm:w-1/4" src="{{ Storage::url('Imagenes/empty.png') }}" />
            <h2 class="mt-2 text-lg font-medium text-center text-gray-800">{{ Auth::user()->name }}, aun no tienes
                ninguna multimedia favorita</h2>
            <p class="mt-1 text-center text-gray-600">
                Para seleccionar multimedia favorita, deberas ir a la pagina principal, buscar los articulos que mas te
                gusten y darle en el boton de me encanta
                <i class="fa-regular fa-heart fa-lg"></i>
            </p>
            <div class="flex flex-col items-center justify-center mt-4 space-y-1 md:flex-row md:space-y-0 md:space-x-1">
                <a href="/">
                    <button type="button"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Ir
                        a la pagina de inicio</button>
                </a>
            </div>
        </section>
    @else
        <div class=" text-center font-medium">
            Hola {{ Auth::user()->name }}, esta es tu multimedia favorita
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  my-2  -mr-4 ">
            @foreach ($posts as $post)
                <article class=" relative bg-white  rounded-xl mr-4 my-6 ">
                    @if ($post->category_id == '4')
                        <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                            data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <x-embed url="{{ $post->image->urlyoutube }}" />
                        </div>
                    @else
                        <figure>
                            <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                                data-mdb-ripple="true" data-mdb-ripple-color="light">
                                <img src="{{ Storage::url($post->image->url) }}" class="w-full h-64" />
                                @section('ogImage')
                                    {{ Storage::url($post->image->url) }}
                                @stop

                                @section('ogTitle')
                                   Leo el mejor
                                @stop
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

    @push('js')
        <script>
            function myFunction() {
                // Get the text field
                var copyText = document.getElementById("myInput");

                // Select the text field
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices


                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);

                // Alert the copied text
                //alert("Copied the text: " + copyText.value);
            }
        </script>
    @endpush

</div>
