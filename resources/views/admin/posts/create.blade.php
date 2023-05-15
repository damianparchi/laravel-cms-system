<x-admin-component>
    @section('content')


        <h1>Create</h1>


        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div style="color: red">{{$errors -> first('title')}}</div>
            <div style="color: red">{{$errors -> first('post_image')}}</div>
            <div style="color: red">{{$errors -> first('body')}}</div>
            <div style="color: red">{{$errors -> first('category')}}</div>

            <div class="form-group">


                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control"
                       placeholder="Enter title...">
            </div>
            <div class="form-group">
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
                          rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control">
                    <option value="">Choose...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>


        </form>

    @endsection
</x-admin-component>

<script>
    $(document).ready(function() {
        $('select[name="category"]').change(function() {
            var category_name = $(this).val();
            $('#categoryDropdownButton').text(category_name);
        });
    });
</script>
