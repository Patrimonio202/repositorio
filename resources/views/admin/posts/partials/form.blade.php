<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del posts']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el slug del post',
        'readonly',
    ]) !!}
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('anocreacion', 'Año creación:') !!}
    {!! Form::text('anocreacion', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el año de creación yyyy-mm-dd',
    ]) !!}

    @error('anocreacion')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('autor', 'Autor:') !!}
    {!! Form::text('autor', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el autor del post']) !!}

    @error('autor')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoria') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('tema_id', 'Tema') !!}
    {!! Form::select('tema_id', $temas, null, ['class' => 'form-control']) !!}
    @error('tema_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        <label class="mr-2"> {{-- para que no esten pegados los labels --}}
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>
    @endforeach

    @error('tags')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label>
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>

    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>

    @error('status')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
{{-- este es para cargar la imagen --}}
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset($post->image) {{-- se utiliza cuando la variable post no puede ser declara --}}
                @if ($post->category_id = '4')
                    <img id="picture" src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                        alt="">
                @else
                    <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
                @endif
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2023/10/03/08/24/goose-8290811_1280.jpg"
                    alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrara en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>



        <p>
            Esta imagen es la mejor
        </p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('archivo', 'Seleccione el archivo pdf o de audio') !!}
    {!! Form::file('archivo', ['class' => 'form-control-file', 'accept' => 'audio/*, .pdf']) !!}


    @error('archivo')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('urlyoutube', 'Url de youtube:') !!}
    {!! Form::text('urlyoutube', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la url de youtube']) !!}

    @error('urlyoutube')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Destacada</p>
    <label>
        {!! Form::radio('destacada', 1, true) !!}
        No
    </label>

    <label>
        {!! Form::radio('destacada', 2) !!}
        Si
    </label>

    @error('destacada')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
