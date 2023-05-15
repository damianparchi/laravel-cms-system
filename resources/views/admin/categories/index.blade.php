<x-admin-component>
    @section('content')
        <div class="row">
            <h1>Categories</h1>
            <div class="col-sm-3">
                <form method="post" action="{{route('admin.categories.create')}}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    </div>
                    @error('name')
                    <span><b>{{$message}}</b></span>
                    @enderror
                    <div>
                        <button class="btn btn-primary btn-block">Create</button>
                    </div>
                </form>
                @if(Session::has('admin.delete'))
                    <div class="mt-2 alert alert-danger">{!! Session::get('admin.delete') !!}</div>
                @elseif(Session::has('admin.create'))
                    <div class="mt-2 alert alert-success">{!! Session::get('admin.create') !!}</div>
                @elseif(Session::has('admin.update'))
                    <div class="mt-2 alert alert-success">{!! Session::get('admin.update') !!}</div>
                @endif
            </div>

        @if(count($categories) > 0)

            <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Categories datatable</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created time</th>
                                        <th>Updated time</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created time</th>
                                        <th>Updated time</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->created_at->diffForHumans()}}</td>
                                            <td>{{$category->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <form action="{{route('admin.categories.delete', $category)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('admin.categories.edit', $category)}}" method="post">
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
            @else
                <h1>There are no categories added yet.</h1>
            @endif
            </div>
        {{$categories->links()}}
    @endsection
</x-admin-component>
