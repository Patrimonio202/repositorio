<div class="admin-dashboard">
    <section class="welcome-panel">
        <div>
            <span class="welcome-kicker">Resumen general</span>
            <h2>Hola, {{ auth()->user()->name }}</h2>
            <p>Gestiona el archivo cultural y revisa el comportamiento reciente del sitio.</p>
        </div>
        @can('admin.posts.create')
            <a href="{{ route('admin.posts.create') }}" class="btn btn-admin-primary">
                <i class="fas fa-plus"></i> Nueva publicación
            </a>
        @endcan
    </section>

    <div class="metrics-grid">
        <article class="metric-card metric-primary">
            <span class="metric-icon"><i class="fas fa-layer-group"></i></span>
            <div><span class="metric-label">Publicaciones</span><strong>{{ number_format($totalposts) }}</strong></div>
            <small>{{ number_format($publicados) }} publicadas</small>
        </article>
        <article class="metric-card metric-teal">
            <span class="metric-icon"><i class="fas fa-eye"></i></span>
            <div><span class="metric-label">Visitas hoy</span><strong>{{ number_format($visitashoy) }}</strong></div>
            <small>{{ number_format($totalvisitas) }} históricas</small>
        </article>
        <article class="metric-card metric-violet">
            <span class="metric-icon"><i class="fas fa-image"></i></span>
            <div><span class="metric-label">Imágenes</span><strong>{{ number_format($totalimagenes) }}</strong></div>
            <small>Contenido visual</small>
        </article>
        <article class="metric-card metric-amber">
            <span class="metric-icon"><i class="fas fa-headphones"></i></span>
            <div><span class="metric-label">Multimedia</span><strong>{{ number_format($totalaudios + $totalvideos) }}</strong></div>
            <small>{{ number_format($totalaudios) }} audios · {{ number_format($totalvideos) }} videos</small>
        </article>
    </div>

    <div class="dashboard-grid">
        <section class="admin-card storage-card">
            <div class="card-heading">
                <div><span class="section-kicker">Sistema</span><h3>Almacenamiento</h3></div>
                <span class="storage-percent">{{ $diskuse }}</span>
            </div>
            <div class="storage-track"><span style="width: {{ $diskuse }}"></span></div>
            <div class="storage-meta"><span>{{ round($disk_used_size, 1) }} GB usados</span><span>{{ round($total_disk_size, 1) }} GB totales</span></div>
            <div class="content-breakdown">
                <div><i class="fas fa-image"></i><span>Imágenes</span><strong>{{ number_format($totalimagenes) }}</strong></div>
                <div><i class="fas fa-file-alt"></i><span>Documentos</span><strong>{{ number_format($totaldocumentos) }}</strong></div>
                <div><i class="fas fa-music"></i><span>Audios</span><strong>{{ number_format($totalaudios) }}</strong></div>
                <div><i class="fas fa-video"></i><span>Videos</span><strong>{{ number_format($totalvideos) }}</strong></div>
            </div>
        </section>

        <section class="admin-card quick-card">
            <div class="card-heading"><div><span class="section-kicker">Accesos</span><h3>Acciones rápidas</h3></div></div>
            <div class="quick-links">
                @can('admin.posts.index')<a href="{{ route('admin.posts.index') }}"><i class="fas fa-list"></i><span>Ver publicaciones</span><b>→</b></a>@endcan
                @can('admin.imagenes')<a href="{{ route('admin.imagenes') }}"><i class="fas fa-images"></i><span>Gestionar imágenes</span><b>→</b></a>@endcan
                @can('admin.users.index')<a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i><span>Administrar usuarios</span><b>→</b></a>@endcan
            </div>
        </section>
    </div>

    <section class="admin-card activity-card">
        <div class="card-heading">
            <div><span class="section-kicker">Analítica</span><h3>Actividad reciente</h3></div>
            <span class="live-badge"><i></i> En vivo</span>
        </div>
        <div class="table-responsive">
            <table class="activity-table">
                <thead><tr><th>Fecha</th><th>Página visitada</th><th class="text-right">Visitas</th></tr></thead>
                <tbody>
                    @forelse ($visitas as $visita)
                        <tr>
                            <td><span class="date-pill">{{ \Carbon\Carbon::parse($visita->fecha)->format('d/m/Y') }}</span></td>
                            <td><span class="page-name">{{ str_replace('-', ' ', $visita->pagina) }}</span></td>
                            <td class="text-right"><strong>{{ number_format($visita->num) }}</strong></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty-state">Todavía no hay actividad registrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($visitas->hasPages())<div class="activity-footer">{{ $visitas->links() }}</div>@endif
    </section>
</div>
