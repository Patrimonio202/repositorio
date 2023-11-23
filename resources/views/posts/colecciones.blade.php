<x-app-layout>
    <div class="max-w-7xl lg:mx-auto mx-4">
        @Switch($tag->slug)
            @case('archivo-antonio-botero')
                <x-colecciones-antoniobotero />
            @break

            @case('archivo-el-santuariano')
                <x-colecciones-elsantuariano />
            @break

            @default
                <span>en desarrollo {{$tag->name}}</span>
        @endswitch

    </div>
</x-app-layout>
