<x-admin-component>
    @section('content')
        <div class="row">
            <h1>Categories</h1>
            <div class="col-sm-3">
                <form method="post" action="{{route('admin.categories.store')}}">
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

            <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="float-left m-0 font-weight-bold text-primary">Categories datatable</h6>

                            <div class="float-right">
                                <div class="col-sm-0">
                                    <form action="{{ route('admin.categories.index') }}" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search" class="form-control" placeholder="Search categories..." value="{{request()->query('search')}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                                            </div>
                                        </div>
                                    <div id="search_list"></div>
                                    </form>
                                </div>
                            </div>
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
                                    @if(count($categories) > 0)
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->created_at->diffForHumans()}}</td>
                                                <td>{{$category->updated_at->diffForHumans()}}</td>
                                                <td>
                                                    <form action="{{route('admin.categories.destroy', $category)}}" method="post">
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
                                    @else
                                        <tr>
                                            <td colspan="6" style="text-align: center">
                                                @if (request()->query('search'))
                                                    <h1>No categories found for query <b>{{request()->query('search')}}</b>.</h1>
                                                @else
                                                    <h1>There are no categories added yet.</h1>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{$categories->appends(['search'=> request()->query('search')])->links()}}
    @endsection
</x-admin-component>
