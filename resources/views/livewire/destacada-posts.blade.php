<div>{{-- wire:init="loadPosts" --}}
    @if (count($posts))
        <div class="glider-contain">
            <ul class="glider">
                @foreach ($posts as $post)
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'sm:mr-4 py-6' }} relative">
                        <article >
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
                                <p class="mb-2 pb-2">
                                    {!! Str::limit($post->body, 100) !!} <a
                                        class="font-bold text-blue-600 no-underline hover:underline"
                                        href="{{ route('posts.show', $post) }}">Leer mas</a>
                                </p>
                            </div>   

                        </article>

                    </li>
                @endforeach
               
            </ul>

            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
      
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>
    @endif
</div>
