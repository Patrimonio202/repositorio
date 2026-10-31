{{-- admin/suscriptores/index - v1.0 (30/10/2026): suscriptores del boletin --}}
@extends('adminlte::page')

@section('title', 'Suscriptores')

@section('content_header')
    <a class="btn btn-admin-primary float-right" href="{{ route('admin.suscriptores.exportar') }}">
        <i class="fas fa-file-csv"></i> Exportar activos (CSV)
    </a>
    <span class="admin-eyebrow">Comunicación</span>
    <h1>Suscriptores del boletín</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Activos (confirmados)</span>
                    <span class="info-box-number">{{ number_format($totales['confirmados']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pendientes de confirmar</span>
                    <span class="info-box-number">{{ number_format($totales['pendientes']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fas fa-user-slash"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dados de baja</span>
                    <span class="info-box-number">{{ number_format($totales['bajas']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            @foreach (['todos' => 'Todos', 'confirmados' => 'Activos', 'pendientes' => 'Pendientes', 'bajas' => 'Bajas'] as $clave => $texto)
                <a href="{{ route('admin.suscriptores.index', ['estado' => $clave]) }}"
                    class="btn btn-sm {{ $estado === $clave ? 'btn-primary' : 'btn-outline-primary' }}">{{ $texto }}</a>
            @endforeach
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Se suscribió</th>
                        <th>Confirmó</th>
                        <th>Baja</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suscriptores as $s)
                        <tr>
                            <td>{{ $s->email }}</td>
                            <td>
                                @if ($s->baja_en)
                                    <span class="badge badge-secondary">Baja</span>
                                @elseif ($s->confirmado_en)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $s->aceptado_en?->format('d/m/Y H:i') }}</td>
                            <td>{{ $s->confirmado_en?->format('d/m/Y H:i') }}</td>
                            <td>{{ $s->baja_en?->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Todavía no hay suscriptores en esta lista.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($suscriptores->hasPages())
            <div class="card-footer">
                {{ $suscriptores->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('csspersonalizados/admin-modern.css') }}">
@stop
