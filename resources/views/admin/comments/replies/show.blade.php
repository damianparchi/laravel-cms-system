<x-admin-component>
    @section('content')


        @if(count($replies) > 0)
            <h1>Replies</h1>

            @if(Session::has('reply-delete-message'))
                <div class="mt-2 alert alert-success">{!! Session::get('reply-delete-message') !!}</div>
            @elseif(Session::has('reply-approve-message'))
                <div class="mt-2 alert alert-success">{!! Session::get('reply-approve-message') !!}</div>
            @elseif(Session::has('reply-unapprove-message'))
                <div class="mt-2 alert alert-warning">{!! Session::get('reply-unapprove-message') !!}</div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Replies datatable</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Avatar</th>
                                        <th>Body</th>
                                        <th>Post</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Approve/Unapprove</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Avatar</th>
                                        <th>Body</th>
                                        <th>Post</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Approve/Unapprove</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($replies as $reply)
                                        <tr>
                                            <td>{{$reply->id}}</td>
                                            <td>{{$reply->author}}</td>
                                            <td><img height="40px" alt="" src="{{$reply->avatar}}"></td>
                                            <td>{{$reply->body}}</td>
                                            <td><a href="{{route('post', $reply->comment->post_id)}}">View Post</a></td>
                                            <td>{{$reply->created_at->diffForHumans()}}</td>
                                            <td>{{$reply->updated_at->diffForHumans()}}</td>
                                            <td>
                                                @if($reply->is_active)
                                                    <form method="post" action="{{route('reply.update', $reply)}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <input type="hidden" name="is_active" value="0">
                                                        <div class="form-group">
                                                            <button name="unapprove" class="btn btn-warning">Un-approve</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="post" action="{{route('reply.update', $reply)}}">
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
                                                <form action="{{route('reply.destroy', $reply)}}" method="">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="btn btn-danger">Delete</button>
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
            <h1>There is no replies available.</h1>
        @endif
        {{$replies->links()}}
    @endsection

</x-admin-component>
