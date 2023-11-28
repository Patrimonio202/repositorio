<div  wire:init="loadPosts">    
    @if (!is_null($tags))
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2  my-2 -mr-4">
            @foreach ($tags as $tag)
                <article class="relative bg-white  rounded-xl mr-4 md:mx-8 lg:mx-8  mt-6 mb-10   ">
                    <figure class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 my-4 ">
                        <div >
                            <img src="{{ Storage::url($tag->url) }}"
                                class="w-full h-full md:h-80 lg:h-96 object-cover " />
                        
                                <a href="{{ route('posts.colecciones', $tag) }}">
                                    <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                                        style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                </a>
                            </div>
                    </figure>
                    <div class=" mb-8">
                        <h1 style="font-family:Raleway-ExtraBold" class=" text-center text-xs ">
                            <a href="{{ route('posts.colecciones', $tag) }}">{{ Str::limit($tag->titulocoleccion, 50) }}</a>
                        </h1>    
                    </div> 
                </article>  
                             
            @endforeach
        </div> 
    @else
        <div wire.target="loadPosts" class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>
    @endif
</div>
