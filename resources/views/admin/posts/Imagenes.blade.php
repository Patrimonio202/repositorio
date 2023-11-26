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
            {!! Form::open([
                'route' => 'admin.updateimagenes',
                'autocomplete' => 'off',
                'files' => true,
                'method' => 'post',
            ]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Archivo:') !!}
                <select class="form-control" name="idimagen"  id="idimagen" onchange="cambiarimagenselect()">
                    <option value="Imagen-barner-1">Barner 1</option>
                    <option value="Imagen-barner-2">Barner 2</option>
                    <option value="Imagen-barner-3">Barner 3</option>
                    <option value="Imagen-barner-4">Barner 4</option>
                    <option value="Imagen-barner-5">Barner 5</option>
                    <option value="Favicon">Favicon</option>
                    <option value="Logo">Logo</option>
                    <option value="Imagenes">Categoria imagenes</option>
                    <option value="Audios">Categoria audios</option>
                    <option value="Libros">Categoria libros</option>
                    <option value="Videos">Categoria videos</option>
                    <option value="Fondologin">Fondo login</option>
                </select>
            </div>


            <div class="row  mb-3">
                <div class="col">

                    <div class="image-wrapper">                        
                            <img name="picture" id="picture" src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                                alt="" width="100%">                        
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file', 'Imagen que se actualizara') !!}
                        {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
                    </div>
                    <p>
                        Las imagenes para el banner deben de estar en formato .jpg </br>
                        Las imagenes para el Favicon deben de estar en .png </br>
                        Las imagenes para el Logo deben de estar en .png </br>
                        El fondo login debe estar en formato .png  dimensiones 667 * 500 </br>
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
        function load() {
            var url=  "https://proyectoeducacion.s3.us-east-2.amazonaws.com/Imagenes/" + $("#idimagen").val()+'.jpg';
            document.getElementById('picture').src = url;
        }
        window.onload = load();

        function cambiarimagenselect(){  
            var extension="";
            var nimagen= $("#idimagen").val();
            if(nimagen=='Logo' || nimagen=='Favicon' || nimagen=='Fondologin'){
                var extension=".png";
            }else{
            var extension=".jpg";
            }
            var url=  "https://proyectoeducacion.s3.us-east-2.amazonaws.com/Imagenes/" + $("#idimagen").val()+extension;
            document.getElementById('picture').src = url;
        }

        //cambiar imagen 
        document.getElementById('file').addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {            
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById('picture').setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>

@stop
