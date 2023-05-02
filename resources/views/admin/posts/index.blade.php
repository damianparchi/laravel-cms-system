<x-admin-component>
    @section('content')

        <h1>All Posts</h1>

        @if(Session::has('post-delete-message'))
            <div class="alert alert-danger">{!! Session::get('post-delete-message') !!}</div>
        @elseif(Session::has('post-create-message'))
            <div class="alert alert-success">{!! Session::get('post-create-message') !!}</div>
        @elseif(Session::has('post-update-message'))
            <div class="alert alert-success">{!! Session::get('post-update-message') !!}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created time</th>
                            <th>Updated time</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created time</th>
                            <th>Updated time</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post -> id}}</td>
                            <td>{{$post -> user -> name}}</td>
                            <td>{{$post -> title}}</td>
                            <td><img height="40px" src="{{$post->post_image}}" alt=""></td>
                            <td>{{$post -> created_at->diffForHumans()}}</td>
                            <td>{{$post -> updated_at->diffForHumans()}}</td>
                            <td>
                                <form action="{{route('post.destroy', $post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('post.edit', $post->id)}}">
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
    @endsection

    @section('scripts')
            <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-component>
