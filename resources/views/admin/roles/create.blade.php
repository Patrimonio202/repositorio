@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
    <span class="admin-eyebrow">Accesos y seguridad</span>
    <h1>Nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.roles.store']) !!}
            @include('admin.roles.partials.form')

            {!! Form::submit('Crear Rol', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

