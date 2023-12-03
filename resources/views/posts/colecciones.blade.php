<x-app-layout>
    <div class="max-w-7xl lg:mx-auto mx-4">
        @Switch($tag->slug)
            @case('archivo-antonio-botero')
                <x-colecciones-antoniobotero />
            @break

            @case('archivo-el-santuariano')
                <x-colecciones-elsantuariano />
            @break

            @case('archivo-patrimonial-de-el-santuario')
                <div class=" mb-8 mt-8">
                    <img src="{{ Storage::url('Imagenes/TituloColeccionPatrimonio.png') }}"
                        class="inline-block  rounded-lg shadow-lg  " alt="Titulo Colecciones patrimonio">
                </div>
            @break

            @case('biblioteca-publica-municipal')
                <x-colecciones-biblioteca />
            @break

            @default
                <span>en desarrollo {{ $tag->name }}</span>
        @endswitch

        @livewire('taglw', ['tag' => $tag])
    </div>
</x-app-layout>
