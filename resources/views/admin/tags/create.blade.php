@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
    <h1>Cultura</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tags.store']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la etiqueta']) !!}

                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>



            <div class="form-group">
                {!! Form::label('slug', 'Slug:') !!}
                {!! Form::text('slug', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Ingrese el slug de la etiqueta',
                    'readonly',
                ]) !!}

                @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group">
                {{-- <label for="">Color:</label>
            <select name="color" id="" class="form-control">
                <option value="red">Color rojo</option>
                <option value="green">Color verde</option>
                <option value="blue" selected>Color azul</option>
            </select> --}}

                {!! Form::label('color', 'Color:') !!}
                {!! Form::select('color', $colors, null, ['class' => 'form-control']) !!}

                @error('color')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {!! Form::submit('Crear etiqueta', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@endsection
