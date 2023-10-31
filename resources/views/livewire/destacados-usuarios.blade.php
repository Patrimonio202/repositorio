<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  my-2  ">
        @foreach ($posts as $post)       
            <article class=" relative bg-white  rounded-xl mr-4 my-6 ">
                <figure>
                    <div class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                        data-mdb-ripple="true" data-mdb-ripple-color="light">
                        <img src="{{ Storage::url($post->image->url) }}" class="w-full" />
                        <a href="{{ route('posts.show', $post) }}">
                            <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                                style="background-color: rgba(251, 251, 251, 0.15)"></div>
                        </a>
                    </div>
                </figure>
                <div class="p-6">
                    <div class=" text-center">
                        <h1 class=" text-center text-lg font-semibold">
                            <a href="">{{ Str::limit($post->name, 40) }}</a>
                        </h1>

                        <p class="text-gray-500 mb-4">
                            <a href=" {{ route('posts.category', $post->category->slug) }}"
                                class="inline-block bg-green-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $post->category->name }}
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
                </div>
            </article>
        @endforeach
        <div x-intersect="$wire.loadMore()"></div>
    </div>
    
    @if ($posts_per_page >= $totalRecords)
        <p class="text-center"> no hay mas registros</p>
    @endif 

    
</div>
