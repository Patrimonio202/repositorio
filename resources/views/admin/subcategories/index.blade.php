@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
  <h1>Lista de Subcategorias</h1>
@stop

@section('content')
@if (session('info'))
        <div class="alert alert-success">
          <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="card">        
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                    <tr>
                        <td>{{$subcategory->id}}</td>
                        <td>{{$subcategory->name}}</td>
                        <td width="10px">
                            @can('admin.categories.edit')
                                <a class="btn btn-primary btn-sm" href="#">Editar</a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('admin.categories.destroy')
                                <form action="" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            @endcan                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@stop
