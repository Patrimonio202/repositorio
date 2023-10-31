@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
    <h1>Cambiar imagenes</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.updateimagenes', 'autocomplete' => 'off', 'files' => true, 'method' => 'post']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Archivo:') !!}
                <select class="form-control" name="idimagen">
                    <option value="Imagen-barner-1">Barner 1</option>
                    <option value="Imagen-barner-2">Barner 2</option>
                    <option value="Imagen-barner-3">Barner 3</option>
                    <option value="Imagen-barner-4">Barner 4</option>
                    <option value="Imagen-barner-5">Barner 5</option>
                    <option value="Favicon">Favicon</option>
                  </select>
            </div>


            <div class="row  mb-3">
                <div class="col">
                  
                        <div class="image-wrapper">
                            @isset($post->image)
                                {{-- se utiliza cuando la variable post no puede ser declara --}}
                                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
                            @else
                            <img name="picture" src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                            alt="" width="100%">
                            @endisset
                        </div>
                    
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file', 'Imagen que se actualizara') !!}
                        {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!} 
                   </div>
                    <p>
                        Esta imagen es la mejor
                    </p>
                </div>
            </div>



            {!! Form::submit('Cambiar imagen', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //cambiar imagen 
        document.getElementById('file').addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            //alert('hasta aqui bien');
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById('picture').setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>

@stop
