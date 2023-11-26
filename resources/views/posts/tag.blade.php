<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
       
        {{-- @foreach ($posts as $post)
             <x-card-post :post="$post"> </x-card-post> 
        @endforeach --}}

<h1 style="font-family:Raleway-ExtraBold" class="uppercase text-center mb-4 text-3xl ">Etiqueta: {{ $tag->name }}</h1>

        @livewire('taglw', ['tag' => $tag])

      
    </div>

</x-app-layout>
