<x-home-component>

    @section('content')
<div style="width: 65%;">
        <!-- Title -->
        <h1 class="mt-4">{{$post -> title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{$post -> user -> name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted {{$post -> created_at -> diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$post -> post_image}}" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">{{$post -> body}}</p>

        <hr>

        @if(Session::has('comment-added-message'))
            <div class="alert alert-success">
                {{session('comment-added-message')}}
            </div>
        @endif

    @if(Auth::check())

        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form method="post" action="{{route('admin.comments.store')}}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group">
                        <textarea class="form-control" name="body" rows="3"></textarea>
                    </div>
                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

   @endif
        <!-- Single Comment -->
    @if($comments->count() > 0)
        @foreach($comments as $comment)
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" height="50px" src="{{$comment->avatar}}" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{$comment->author}} <small>({{$comment->created_at->diffForHumans()}})</small></h5>
                    <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                    <textarea class="form-control" rows="3">{{$comment->body}}</textarea>
                </div>
            </div>
        @endforeach

        {{$comments->links()}}

    @else
        <div class="alert alert-info">There are no comments yet.</div>
    @endif
</div>
    @endsection

</x-home-component>
