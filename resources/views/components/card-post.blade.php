  @props(['post'])

<div class="@if($loop->first) @endif">
  <article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
      @if ($post->image)
          <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="">
      @else
          <img class="w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg" alt="">
      @endif

      <div class="px-6">
          <h1 class="font-bold text-xl mb-2">
              <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
          </h1>          
      </div>

      <div class="px-6 pt-2 pb-2 ">
          @foreach ($post->tags as $tag)
              <a href="{{ route('posts.tag', $tag) }}"
                  class="inline-block bg-{{ $tag->color }}-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2">{{ $tag->name }}</a>
          @endforeach

      </div>
  </article>
</div>
