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

        @if(count($posts) > 0)

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
                                <th>Author</th>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Category</th>
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
                                <th>Comments</th>
                                <th>Category</th>
                                <th>Created time</th>
                                <th>Updated time</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td><a href="{{route('post', $post->slug)}}">{{$post->slug}}</a></td>
                                    <td><a href="{{route('comments.show', $post)}}">View Comments</a></td>
                                    <td>
                                        @foreach($post->categories as $category)
                                            {{$category->name}}
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$post->created_at->diffForHumans()}}</td>
                                    <td>{{$post->updated_at->diffForHumans()}}</td>
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
            {{$posts->links()}}
        @else
            <h1> There are no posts available. </h1>

        @endif

    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

        <!-- Page level custom scripts -->
        {{--            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}
    @endsection
</x-admin-component>
