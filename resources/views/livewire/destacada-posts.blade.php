<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-7">
        @forelse ($tags as $tag)
            <a href="{{ route('posts.colecciones', $tag) }}"
                class="group relative block overflow-hidden rounded-2xl bg-slate-900 shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="aspect-[16/9] overflow-hidden">
                    <img src="{{ $tag->miniatura_url }}" loading="lazy" decoding="async"
                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                        alt="{{ $tag->titulocoleccion }}">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-900/10 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-4 p-5 md:p-6">
                    <div>
                        <span class="mb-2 inline-flex rounded-full bg-white/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-widest text-white backdrop-blur-md">Colección</span>
                        <h3 class="text-lg font-semibold leading-tight text-white md:text-xl">{{ Str::limit($tag->titulocoleccion, 62) }}</h3>
                    </div>
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-white text-slate-900 transition group-hover:bg-cyan-500 group-hover:text-white" aria-hidden="true">→</span>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-500">
                No hay colecciones destacadas disponibles.
            </div>
        @endforelse
    </div>
</div>
