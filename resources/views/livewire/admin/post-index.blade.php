<div class="card admin-table-card admin-listing">
 <div class="card-header admin-toolbar">
    <div class="admin-search"><i class="fas fa-search"></i><input wire:model.live.debounce.300ms="search" class="form-control" placeholder="Buscar publicaciones..."></div>
    <span class="result-count">{{ $posts->total() }} publicaciones</span>
 </div>
@if ($posts->count())   

  <div class="card-body p-0 table-responsive">
    <table class="table admin-table mb-0">
        <thead>
         <tr>
            <th>ID</th>
            <th>Publicación</th>
            <th>Año creación</th>
            <th>Autor</th>
            <th>Destacada</th>
            <th>Tema</th>
            <th class="text-right">Acciones</th>
         </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td><span class="id-badge">#{{$post->id}}</span></td>
                    <td><strong class="post-title">{{$post->name}}</strong></td>
                    <td>{{$post->anocreacion}}</td>
                    <td>{{$post->autor}}</td>
                    @if ($post->destacada==1)
                        <td><span class="status-badge status-muted">No</span></td>
                    @else
                       <td><span class="status-badge status-featured"><i class="fas fa-star"></i> Sí</span></td>
                    @endif                    
                    <td>{{$post->tema->name}}</td>
                    <td class="text-right admin-actions">
                        <a class="btn btn-admin-edit btn-sm" href="{{route('admin.posts.edit',$post )}}" title="Editar"><i class="fas fa-pen"></i><span>Editar</span></a>
                        <form action="{{route('admin.posts.destroy',$post )}}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-admin-delete btn-sm" type="submit" title="Eliminar"><i class="far fa-trash-alt"></i><span>Eliminar</span></button>
                        </form>
                    </td>
                </tr>
            @endforeach         

        </tbody>

    </table>
  </div>

  <div class="card-footer">
    {{$posts->links()}}
  </div>
  @else
  <div class="admin-empty"><i class="far fa-file-alt"></i><strong>No encontramos publicaciones</strong><span>Prueba con otro término o crea una publicación nueva.</span></div>
  </div>
  @endif
</div>
