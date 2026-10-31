<x-app-layout>
    <div class="mx-auto max-w-[1600px] px-4 pt-5 sm:px-6 lg:px-8">
        <x-carrousel />
    </div>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm md:flex md:items-center md:gap-6 md:p-5">
            <nav class="mb-4 flex items-center justify-center gap-2 md:mb-0" aria-label="Buscar por tipo de archivo">
                @foreach ([
                    [1, 'Imagenes.jpg', 'Imágenes'],
                    [3, 'Libros.jpg', 'Publicaciones'],
                    [4, 'Videos.jpg', 'Videos'],
                    [2, 'Audios.jpg', 'Audios'],
                ] as [$category, $image, $label])
                    <a href="{{ route('posts.buscar') . '?category%5B%5D=' . $category }}"
                        class="group grid h-12 w-12 place-items-center rounded-xl border border-slate-200 bg-slate-50 transition hover:-translate-y-0.5 hover:border-cyan-500 hover:bg-cyan-50"
                        title="Explorar {{ strtolower($label) }}" aria-label="Explorar {{ strtolower($label) }}">
                        <img src="{{ Storage::url('Imagenes/' . $image) }}" class="h-7 w-7 object-contain transition group-hover:scale-110" alt="">
                    </a>
                @endforeach
            </nav>

            <form action="{{ route('posts.buscar') }}" class="relative flex-1">
                <label for="home-search" class="sr-only">Buscar en el repositorio</label>
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fas fa-search"></i></span>
                <input type="search" name="textobuscar" id="home-search" required
                    class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 pl-11 pr-28 text-sm text-slate-900 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500"
                    placeholder="Buscar imágenes, publicaciones, audios o videos...">
                <button type="submit" class="absolute bottom-1.5 right-1.5 top-1.5 rounded-lg bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-cyan-700">Buscar</button>
            </form>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8" aria-labelledby="featured-title">
        <header class="mb-7 flex items-end justify-between border-b border-slate-200 pb-5">
            <div>
                <span class="mb-2 inline-block text-xs font-bold uppercase tracking-[.2em] text-cyan-700">Explora el patrimonio</span>
                <h2 id="featured-title" class="text-2xl font-bold tracking-tight text-slate-900 md:text-3xl">Colecciones destacadas</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-500">Recorridos temáticos que reúnen la memoria cultural de El Santuario.</p>
            </div>
        </header>
        <livewire:destacada-posts lazy />
    </section>

    <section class="bg-white/65 py-12" aria-labelledby="recent-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <header class="mb-7 flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <span class="mb-2 inline-block text-xs font-bold uppercase tracking-[.2em] text-amber-600">Descubre algo diferente</span>
                    <h2 id="recent-title" class="text-2xl font-bold tracking-tight text-slate-900 md:text-3xl">Archivos recientes</h2>
                    <p class="mt-2 max-w-2xl text-sm text-slate-500">Una selección aleatoria de publicaciones cambia cada vez que visitas la portada.</p>
                </div>
                <a href="{{ route('posts.buscar') }}" class="text-sm font-semibold text-cyan-700 hover:text-cyan-900">Ver todo el repositorio →</a>
            </header>
            @livewire('multimedia-publicada')
        </div>
    </section>
</x-app-layout>
