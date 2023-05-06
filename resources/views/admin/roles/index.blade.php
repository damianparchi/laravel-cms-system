<x-admin-component>
    @section('content')

        <h1>Roles</h1>
        <div class="row">
            <div class="col-sm-3">
                <form action="{{route('roles.store')}}" method="post" >
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="">
                    </div>
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                    @if(Session::has('role-delete-message'))
                        <div class="mt-2 alert alert-danger">{!! Session::get('role-delete-message') !!}</div>
                    @elseif(Session::has('role-update-message'))
                        <div class="mt-2 alert alert-success">{!! Session::get('role-update-message') !!}</div>
                    @elseif(Session::has('role-nothing-message'))
                        <div class="mt-2 alert alert-primary">{!! Session::get('role-nothing-message') !!}</div>
                    @endif
                </form>

            </div>

            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Posts datatable</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form action="{{route('roles.delete', $role)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('roles.edit', $role)}}" method="post">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</x-admin-component>
