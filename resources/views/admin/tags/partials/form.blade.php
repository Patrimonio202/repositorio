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

<div class="form-group">
    <p class="font-weight-bold">Colección</p>
    <label>
        {!! Form::radio('coleccion', 1, true) !!}
        No
    </label>

    <label>
        {!! Form::radio('coleccion', 2) !!}
        Si
    </label>

    @error('coleccion')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- este es para cargar la imagen --}}
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset($tag->url)
                <img name="picture" id="picture" src="{{ Storage::url($tag->url) }}" alt=""  width="100%">
            @else
                <img name="picture" id="picture" src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                    alt="" width="100%">
            @endisset
        </div>

    </div>

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrara en el preview de las colecciones') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <p>
            Selecciona una imagen para cambiar la foto de la colección
        </p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('titulocoleccion', 'Titulo de la colección:') !!}
    {!! Form::text('titulocoleccion', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el titulo de la coleccion',
    ]) !!}

    @error('titulocoleccion')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>
