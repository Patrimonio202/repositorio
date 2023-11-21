<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
       
        {{-- @foreach ($posts as $post)
             <x-card-post :post="$post"> </x-card-post> 
        @endforeach --}}

        @livewire('taglw', ['tag' => $tag])

      
    </div>

</x-app-layout>
