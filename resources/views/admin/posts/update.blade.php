<x-admin-component>
    @section('content')


        <h1>Edit a post</h1>


        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="color: red">{{$errors -> first('title')}}</div>
            <div style="color: red">{{$errors -> first('post_image')}}</div>
            <div style="color: red">{{$errors -> first('body')}}</div>
            <div class="form-group">


                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{$post->title}}"
                       class="form-control"
                       placeholder="Enter title...">
            </div>
            <div class="form-group">
                <div><img src="{{$post->post_image}}" alt=""/></div>
                <label for="file">File</label>
                <input type="file"
                       name="post_image"
                       id="post_image"
                       class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body"
                          class="form-control"
                          id="body"
                          cols="30"
                          rows="10">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    @endsection
</x-admin-component>
