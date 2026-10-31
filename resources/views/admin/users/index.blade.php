@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
    <span class="admin-eyebrow">Accesos y seguridad</span>
    <h1>Usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
