<x-admin-component>
    @section('content')

        @if(count($comments) > 0)
            <h1>Comments</h1>
                <div class="col-sm-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Comments datatable</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Id</th>
                                        <th>Author</th>
                                        <th>Email</th>
                                        <th>Avatar</th>
                                        <th>Body</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Id</th>
                                        <th>Author</th>
                                        <th>Email</th>
                                        <th>Avatar</th>
                                        <th>Body</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{$comment->id}}</td>
                                            <td><a href="{{route('post', $comment->post_id)}}">View Post</a></td>
                                            <td>{{$comment->author}}</td>
                                            <td>{{$comment->email}}</td>
                                            <td><img height="40px" alt="" src="{{$comment->avatar}}"></td>
                                            <td>{{$comment->body}}</td>
                                            <td>
                                                <form action="" method="post">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="" method="post">
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
        @else
            <h1>There is no comments available.</h1>
        @endif

    @endsection
</x-admin-component>
