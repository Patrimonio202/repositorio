<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  my-2 -mr-4  ">
        @foreach ($posts as $post)
            <article class=" relative bg-white  rounded-xl mr-4 my-6 ">
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
                            <img src="{{ Storage::url($post->image->url) }}" class="w-full h-60" />
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
                    <i onclick="changeState('compartirjtc-{{ $post->id }}')"
                        class="fa-solid fa-share-nodes fa-lg"></i>
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
</div>
