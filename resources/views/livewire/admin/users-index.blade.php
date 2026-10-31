<div class="admin-listing">
   <div class="card admin-table-card">
       <div class="card-header admin-toolbar">
        <div class="admin-search"><i class="fas fa-search"></i><input wire:model.live.debounce.300ms="search" class="form-control" placeholder="Buscar por nombre o correo..."></div>
        <span class="result-count">{{ $users->total() }} usuarios</span>
       </div>
@if($users->count())
       <div class="card-body p-0 table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><span class="id-badge">#{{$user->id}}</span></td>
                        <td><div class="user-cell"><span class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span><strong>{{$user->name}}</strong></div></td>
                        <td><span class="text-muted">{{$user->email}}</span></td>
                        <td class="text-right">
                            <a class="btn btn-admin-edit btn-sm" href="{{route('admin.users.edit', $user)}}"><i class="fas fa-user-shield"></i> Gestionar rol</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       </div>

       <div class="card-footer">
        {{$users->links()}}
       </div>
       @else
       <div class="admin-empty"><i class="fas fa-users"></i><strong>No encontramos usuarios</strong><span>Prueba con otro término de búsqueda.</span></div>
       </div>
       @endif
   </div>
</div>
