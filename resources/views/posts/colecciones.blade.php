<x-app-layout>
    <div class="max-w-7xl lg:mx-auto mx-4">
        @if ($tag->slug == 'archivo-antonio-botero')
            <x-colecciones-antoniobotero />
        @else
          <p>pagina en desarrollo</p>
        @endif


    </div>
</x-app-layout>
