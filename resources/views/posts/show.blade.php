<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-blod text-black-600 py-2">{{ $post->name }}</h1>

        {{-- <div class="text-lg text-gray-500 mb-2">
            {!! $post->body !!}
        </div> --}}

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- contenido principal --}}


            <div class="lg:col-span-2">
                {{-- aqui organizamos la imagen --}}
                @if ($post->category->id == 1)
                    <figure class="aspect-[16/9]">
                        @if ($post->image)
                            <img class="rounded-xl" src="{{ Storage::url($post->image->url) }}" alt="">
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
                            <iframe width="100%" height="500"
                                src="{{ Storage::url('archivos/CP-510-47-994000022586-0.PDF') }}#toolbar=0&navpanes=0&scrollbar=0"></iframe>
                            {{-- <embed src="{{ Storage::url('archivos/CP-510-47-994000022586-0.PDF') }}" type="application/pdf" width="100%" height="500px" /> --}}
                            {{-- <embed
                                src="{{ Storage::url('archivos/CP-510-47-994000022586-0.PDF') }}#toolbar=0&navpanes=0&scrollbar=0"
                                type="application/pdf" width="100%" height="500px" /> --}}
                            <div>
                    </figure>
                @endif

                @if ($post->category->id == 4)
                    <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg  "
                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                        <x-embed url="{{ $post->image->urlyoutube }}" aspect-ratio="4:3" />
                    </div>
                @endif

                <div class="text-base text-gray-500 mt-4 text-justify">
                    {!! $post->body !!}
                </div>
            </div>



            {{-- Contenido relacionado --}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4 py-4">Mas en {{ $post->category->name }}
                    <ul>
                        @foreach ($similares as $similar)
                            <li class="mb-4">
                                <a class="flex" href="{{ route('posts.show', $similar) }}">

                                    @if ($similar->image)
                                        <img class="w-36 h-20 object-cover object-center rounded-xl px-2"
                                            src="{{ Storage::url($similar->image->url) }}" alt="">
                                    @else
                                        {{--    <img class="w-36 h-20 object-cover object-center"
                                            src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                                            alt=""> --}}
                                    @endif
                                    <span class="text-gray-700 text-base text-justify">{{ $similar->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </h1>
            </aside>
            <div class="mt-6 lg:col-span-2">
                @livewire('question', ['model'=>$post])
            </div> 
        </div>   
            
    </div>
   
</x-app-layout>
