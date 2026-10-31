<div>
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($posts as $post)
            <article class="group flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/80 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <a href="{{ route('posts.show', $post) }}" class="relative block aspect-[16/10] overflow-hidden bg-slate-100">
                    @if ($post->category_id == '4')
                        <div class="h-full w-full [&_iframe]:h-full [&_iframe]:w-full">
                            <x-embed url="{{ $post->image->urlyoutube }}" />
                        </div>
                    @else
                        <img src="{{ $post->image->miniatura_url }}" loading="lazy" decoding="async"
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                            alt="{{ $post->name }}">
                    @endif
                    <span class="absolute left-4 top-4 rounded-full bg-slate-950/65 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-md">
                        {{ $post->category->name }}
                    </span>
                </a>

                <div class="flex flex-1 flex-col p-5">
                    <p class="mb-2 text-xs font-medium text-slate-500">
                        {{ \Carbon\Carbon::parse($post->anocreacion)->format('Y') }} · {{ $post->autor }}
                    </p>
                    <h3 class="mb-3 text-base font-bold leading-snug text-slate-900">
                        <a href="{{ route('posts.show', $post) }}" class="transition hover:text-cyan-700">{{ Str::limit($post->name, 62) }}</a>
                    </h3>
                    <p class="mb-5 text-sm leading-6 text-slate-600">
                        {{ Str::limit(strip_tags($post->body), 115) }}
                    </p>

                    <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-4">
                        <a href="{{ route('posts.show', $post) }}" class="text-xs font-bold text-cyan-700 hover:text-cyan-900">Explorar archivo →</a>
                        <div class="flex items-center gap-1 text-slate-500">
                            <button type="button" wire:click="edit({{ $post->id }})" class="grid h-9 w-9 place-items-center rounded-full hover:bg-slate-100 hover:text-cyan-700" title="Compartir" aria-label="Compartir {{ $post->name }}"><i class="fas fa-share-alt"></i></button>
                            @auth
                                <button type="button" wire:click="meinteresa({{ $post->id }})" class="grid h-9 w-9 place-items-center rounded-full hover:bg-slate-100 hover:text-cyan-700" title="Guardar" aria-label="Guardar {{ $post->name }}"><i class="{{ $post->userVotes ? 'fas' : 'far' }} fa-bookmark"></i></button>
                                <button type="button" wire:click="megusta({{ $post->id }})" class="grid h-9 w-9 place-items-center rounded-full hover:bg-rose-50 hover:text-rose-600" title="Me gusta" aria-label="Marcar como favorito"><i class="{{ $post->userVoteslike ? 'fas' : 'far' }} fa-heart"></i></button>
                                <button type="button" wire:click="download({{ $post->id }})" class="grid h-9 w-9 place-items-center rounded-full hover:bg-slate-100 hover:text-cyan-700" title="Descargar" aria-label="Descargar {{ $post->name }}"><i class="fas fa-download"></i></button>
                            @else
                                <a href="{{ route('login') }}" class="grid h-9 w-9 place-items-center rounded-full hover:bg-slate-100 hover:text-cyan-700" title="Inicia sesión para guardar"><i class="far fa-bookmark"></i></a>
                            @endauth
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center text-sm text-slate-500">
                No hay archivos publicados disponibles.
            </div>
        @endforelse
    </div>

    @if ($posts_per_page < $totalRecords)
        <div class="mt-9 flex justify-center">
            <button type="button" wire:click="loadMore" wire:loading.attr="disabled"
                class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 disabled:opacity-60">
                <span wire:loading.remove wire:target="loadMore">Mostrar más archivos</span>
                <span wire:loading wire:target="loadMore">Cargando...</span>
            </button>
        </div>
    @endif

    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">Compartir archivo</x-slot>
        <x-slot name="content">
            <div class="mb-7 flex items-center justify-center gap-6">
                <a href="https://api.whatsapp.com/send?text={{ $post_slug }}" target="_blank" rel="noopener noreferrer" class="text-center text-xs"><img src="{{ Storage::url('Imagenes/WhatsApp.png') }}" alt="WhatsApp" class="mb-1 h-14 w-14 transition hover:scale-105">WhatsApp</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $post_slug }}" target="_blank" rel="noopener noreferrer" class="text-center text-xs"><img src="{{ Storage::url('Imagenes/Facebook.png') }}" alt="Facebook" class="mb-1 h-14 w-14 transition hover:scale-105">Facebook</a>
                <a href="https://twitter.com/intent/tweet?url={{ $post_slug }}" target="_blank" rel="noopener noreferrer" class="text-center text-xs"><img src="{{ Storage::url('Imagenes/X.webp') }}" alt="X" class="mb-1 h-14 w-14 transition hover:scale-105">X</a>
            </div>
            <div class="flex items-center gap-3">
                <x-input id="myInput" class="w-full" value="{{ $post_slug }}"></x-input>
                <button type="button" onclick="myFunction()" class="grid h-10 w-10 place-items-center rounded-lg bg-slate-100" title="Copiar enlace"><i class="far fa-copy"></i></button>
            </div>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
