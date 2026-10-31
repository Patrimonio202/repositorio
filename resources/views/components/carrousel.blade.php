@php
    $banners = collect(range(1, 5))->map(fn ($numero) => [
        'src' => \App\Models\Image::urlGrande("Imagenes/Imagen-barner-{$numero}.jpg"),
        'srcset' => \App\Models\Image::srcsetBanner("Imagenes/Imagen-barner-{$numero}.jpg"),
        'alt' => $numero === 1
            ? 'Bienvenida al Repositorio Digital Patrimonio Cultural de El Santuario'
            : "Banner destacado {$numero} del patrimonio cultural de El Santuario",
    ]);
@endphp

<section class="heritage-carousel" data-heritage-carousel aria-roledescription="carrusel"
    aria-label="Contenido destacado del repositorio">
    <div class="heritage-carousel__viewport">
        <div class="heritage-carousel__slides" aria-live="off">
            @foreach ($banners as $index => $banner)
                <article class="heritage-carousel__slide {{ $index === 0 ? 'is-active' : '' }}"
                    data-slide aria-hidden="{{ $index === 0 ? 'false' : 'true' }}">
                    @if ($index === 0)
                        <a href="{{ route('inicio.acercade') }}" class="heritage-carousel__media" tabindex="0">
                            <img src="{{ $banner['src'] }}" @if ($banner['srcset']) srcset="{{ $banner['srcset'] }}" @endif
                                sizes="(min-width: 1280px) 1200px, calc(100vw - 48px)" width="1920" height="500"
                                fetchpriority="high" decoding="async" alt="{{ $banner['alt'] }}">
                        </a>
                    @else
                        <div class="heritage-carousel__media">
                            <img data-src="{{ $banner['src'] }}" @if ($banner['srcset']) data-srcset="{{ $banner['srcset'] }}" @endif
                                sizes="(min-width: 1280px) 1200px, calc(100vw - 48px)" width="1920" height="500"
                                loading="lazy" decoding="async" alt="{{ $banner['alt'] }}">
                        </div>
                    @endif
                </article>
            @endforeach
        </div>

        <div class="heritage-carousel__shade" aria-hidden="true"></div>

        <button class="heritage-carousel__arrow heritage-carousel__arrow--prev" type="button" data-carousel-prev
            aria-label="Ver banner anterior">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
        </button>
        <button class="heritage-carousel__arrow heritage-carousel__arrow--next" type="button" data-carousel-next
            aria-label="Ver banner siguiente">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
        </button>

        <div class="heritage-carousel__footer">
            <div class="heritage-carousel__dots" role="tablist" aria-label="Seleccionar banner">
                @foreach ($banners as $index => $banner)
                    <button type="button" class="heritage-carousel__dot {{ $index === 0 ? 'is-active' : '' }}"
                        data-carousel-dot="{{ $index }}" role="tab" aria-label="Mostrar banner {{ $index + 1 }}"
                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}"></button>
                @endforeach
            </div>
            <span class="heritage-carousel__count" aria-hidden="true"><b data-carousel-current>01</b> / 05</span>
        </div>
        <div class="heritage-carousel__progress" aria-hidden="true"><span data-carousel-progress></span></div>
    </div>
</section>

<style>
    .heritage-carousel{--carousel-accent:#08a5ad;--carousel-gold:#d2a25c;position:relative;width:100%;isolation:isolate}
    .heritage-carousel__viewport{position:relative;overflow:hidden;aspect-ratio:1920/500;min-height:190px;max-height:500px;background:#dfe7e8;border:1px solid rgba(15,53,70,.08);border-radius:22px;box-shadow:0 18px 50px rgba(19,48,64,.14)}
    .heritage-carousel__slides,.heritage-carousel__slide,.heritage-carousel__media{position:absolute;inset:0}
    .heritage-carousel__slide{visibility:hidden;opacity:0;transform:scale(1.015);transition:opacity .55s ease,transform 1.1s ease,visibility .55s;will-change:opacity}
    .heritage-carousel__slide.is-active{visibility:visible;opacity:1;transform:scale(1);z-index:1}
    .heritage-carousel__media{display:block}
    .heritage-carousel__media img{display:block;width:100%;height:100%;object-fit:cover;object-position:center;background:#e6ecec}
    .heritage-carousel__shade{position:absolute;inset:0;z-index:2;pointer-events:none;background:linear-gradient(90deg,rgba(5,34,48,.12),transparent 22%,transparent 78%,rgba(5,34,48,.12))}
    .heritage-carousel__arrow{position:absolute;top:50%;z-index:4;display:grid;place-items:center;width:46px;height:46px;padding:0;border:1px solid rgba(255,255,255,.48);border-radius:50%;color:#fff;background:rgba(9,44,58,.26);box-shadow:0 6px 18px rgba(0,0,0,.12);backdrop-filter:blur(8px);transform:translateY(-50%);transition:background .2s,transform .2s,border-color .2s;cursor:pointer}
    .heritage-carousel__arrow:hover{background:rgba(8,165,173,.92);border-color:transparent;transform:translateY(-50%) scale(1.06)}
    .heritage-carousel__arrow:focus-visible,.heritage-carousel__dot:focus-visible{outline:3px solid #fff;outline-offset:3px}
    .heritage-carousel__arrow svg{width:23px;height:23px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .heritage-carousel__arrow--prev{left:22px}.heritage-carousel__arrow--next{right:22px}
    .heritage-carousel__footer{position:absolute;z-index:4;right:24px;bottom:19px;left:24px;display:flex;align-items:center;justify-content:space-between;pointer-events:none}
    .heritage-carousel__dots{display:flex;align-items:center;gap:8px;padding:8px 10px;border:1px solid rgba(255,255,255,.35);border-radius:30px;background:rgba(10,45,59,.28);backdrop-filter:blur(8px);pointer-events:auto}
    .heritage-carousel__dot{width:7px;height:7px;padding:0;border:0;border-radius:10px;background:rgba(255,255,255,.62);transition:width .25s,background .25s;cursor:pointer}
    .heritage-carousel__dot.is-active{width:26px;background:#fff}
    .heritage-carousel__count{padding:7px 11px;border-radius:20px;color:rgba(255,255,255,.72);background:rgba(10,45,59,.28);font-size:11px;font-weight:700;letter-spacing:.08em;backdrop-filter:blur(8px)}
    .heritage-carousel__count b{color:#fff;font-size:13px}
    .heritage-carousel__progress{position:absolute;right:0;bottom:0;left:0;z-index:5;height:3px;background:rgba(255,255,255,.18)}
    .heritage-carousel__progress span{display:block;width:0;height:100%;background:linear-gradient(90deg,var(--carousel-gold),var(--carousel-accent))}
    .heritage-carousel__progress span.is-running{animation:heritage-progress 6.5s linear forwards}
    @keyframes heritage-progress{to{width:100%}}
    @media(max-width:767px){.heritage-carousel__viewport{aspect-ratio:16/7;min-height:150px;border-radius:14px}.heritage-carousel__arrow{width:36px;height:36px}.heritage-carousel__arrow svg{width:18px;height:18px}.heritage-carousel__arrow--prev{left:10px}.heritage-carousel__arrow--next{right:10px}.heritage-carousel__footer{right:12px;bottom:10px;left:12px}.heritage-carousel__dots{gap:6px;padding:6px 8px}.heritage-carousel__count{display:none}}
    @media(prefers-reduced-motion:reduce){.heritage-carousel__slide{transition:none}.heritage-carousel__progress{display:none}}
</style>

<script>
    (() => {
        const root = document.currentScript.previousElementSibling.previousElementSibling;
        if (!root || !root.matches('[data-heritage-carousel]') || root.dataset.ready) return;
        root.dataset.ready = 'true';

        const slides = [...root.querySelectorAll('[data-slide]')];
        const dots = [...root.querySelectorAll('[data-carousel-dot]')];
        const current = root.querySelector('[data-carousel-current]');
        const progress = root.querySelector('[data-carousel-progress]');
        const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
        let active = 0;
        let timer;
        let pointerStart = null;

        const load = (index) => {
            const image = slides[index]?.querySelector('img[data-src]');
            if (!image) return;
            image.src = image.dataset.src;
            if (image.dataset.srcset) image.srcset = image.dataset.srcset;
            image.removeAttribute('data-src');
            image.removeAttribute('data-srcset');
        };

        const restartProgress = () => {
            if (!progress || reduceMotion) return;
            progress.classList.remove('is-running');
            void progress.offsetWidth;
            progress.classList.add('is-running');
        };

        const show = (index, userInitiated = false) => {
            active = (index + slides.length) % slides.length;
            load(active);
            slides.forEach((slide, i) => {
                const selected = i === active;
                slide.classList.toggle('is-active', selected);
                slide.setAttribute('aria-hidden', selected ? 'false' : 'true');
                const link = slide.querySelector('a');
                if (link) link.tabIndex = selected ? 0 : -1;
            });
            dots.forEach((dot, i) => {
                const selected = i === active;
                dot.classList.toggle('is-active', selected);
                dot.setAttribute('aria-selected', selected ? 'true' : 'false');
            });
            current.textContent = String(active + 1).padStart(2, '0');
            restartProgress();
            window.setTimeout(() => load((active + 1) % slides.length), userInitiated ? 80 : 700);
        };

        const stop = () => window.clearInterval(timer);
        const start = () => {
            stop();
            if (!reduceMotion && !document.hidden) timer = window.setInterval(() => show(active + 1), 6500);
            restartProgress();
        };
        const move = (direction) => { show(active + direction, true); start(); };

        root.querySelector('[data-carousel-prev]').addEventListener('click', () => move(-1));
        root.querySelector('[data-carousel-next]').addEventListener('click', () => move(1));
        dots.forEach((dot) => dot.addEventListener('click', () => { show(Number(dot.dataset.carouselDot), true); start(); }));
        root.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') move(-1);
            if (event.key === 'ArrowRight') move(1);
        });
        root.addEventListener('pointerdown', (event) => { pointerStart = event.clientX; });
        root.addEventListener('pointerup', (event) => {
            if (pointerStart === null) return;
            const distance = event.clientX - pointerStart;
            pointerStart = null;
            if (Math.abs(distance) > 55) move(distance > 0 ? -1 : 1);
        });
        root.addEventListener('mouseenter', stop);
        root.addEventListener('mouseleave', start);
        root.addEventListener('focusin', stop);
        root.addEventListener('focusout', start);
        document.addEventListener('visibilitychange', () => document.hidden ? stop() : start());

        const idle = window.requestIdleCallback || ((callback) => window.setTimeout(callback, 900));
        idle(() => load(1));
        show(0);
        start();
    })();
</script>
