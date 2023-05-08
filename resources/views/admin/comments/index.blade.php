<x-admin-component>
    @section('content')


        @if(count($comments) > 0)
            <h1>Comments</h1>

            @if(Session::has('comment-delete-message'))
                <div class="mt-2 alert alert-danger">{!! Session::get('comment-delete-message') !!}</div>
            @elseif(Session::has('comment-approve-message'))
                <div class="mt-2 alert alert-success">{!! Session::get('comment-approve-message') !!}</div>
            @elseif(Session::has('comment-unapprove-message'))
                <div class="mt-2 alert alert-warning">{!! Session::get('comment-unapprove-message') !!}</div>
            @endif
            <div class="row">
                <div class="col-sm-12">
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
                                        <th>Approve/Unapprove</th>
                                        <th>Delete</th>
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
                                        <th>Approve/Unapprove</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{$comment->id}}</td>
                                            <td><a href="{{route('post', $comment->post_id)}}">View Post - {{$comment->post_id}}</a></td>
                                            <td>{{$comment->author}}</td>
                                            <td>{{$comment->email}}</td>
                                            <td><img height="40px" alt="" src="{{$comment->avatar}}"></td>
                                            <td>{{$comment->body}}</td>
                                            <td>
                                                @if($comment->is_active)
                                                    <form method="post" action="{{route('admin.comments.update', $comment)}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <input type="hidden" name="is_active" value="0">
                                                        <div class="form-group">
                                                            <button name="unapprove" class="btn btn-warning">Un-approve</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action="{{route('admin.comments.update', $comment)}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <input type="hidden" name="is_active" value="1">
                                                        <div class="form-group">
                                                            <button name="approve" class="btn btn-success">Approve</button>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{route('admin.comments.destroy', $comment)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
