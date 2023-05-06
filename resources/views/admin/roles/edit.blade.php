<x-admin-component>
    @section('content')

        <h1>Update role</h1>
        <div class="row">
            <form action="{{route('roles.update', $role)}}" method="post">
                @csrf
                @method("PUT")
                <div class="col-sm-3">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{$role->name}}"
                           class="form-control">
                    <button type="submit" class="mt-2 btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <div class="mt-2 row">
            <div class="ml-3 col-lg-6">
                @if($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions datatable</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <td>Options</td>
                                    <td>Id</td>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td>Options</td>
                                    <td>Id</td>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td><input type="checkbox"
                                               @foreach($role->permissions as $role_permission)
                                                   @if($role_permission->slug == $permission->slug)
                                                       checked
                                                   @endif
                                                @endforeach
                                        ></td>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <form action="{{route('role.permission.detach', $role)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button type="submit" class="btn btn-danger"
                                                    @if(!$role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                >Detach</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('role.permission.attach', $role)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button type="submit" class="btn btn-primary"
                                                    @if($role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                >Attach</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endsection
</x-admin-component>
