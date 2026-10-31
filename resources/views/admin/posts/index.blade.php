@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
    <a class="btn btn-admin-primary float-right" href="{{ route('admin.posts.create') }}"><i class="fas fa-plus"></i> Nueva publicación</a>
    <span class="admin-eyebrow">Gestión de contenido</span>
    <h1>Publicaciones</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    @livewire('admin.post-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
