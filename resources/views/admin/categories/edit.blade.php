<x-admin-component>
    @section('content')
    <div class="row">
        <h1>Editing a <b>{{$category->name}}</b> category</h1>
        <form action="{{route('admin.categories.update', $category)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group col-sm-2">
                <label>Name</label>
                <input value="{{$category->name}}" class="form-control" type="text" for="name" name="name" id="name">
                <button class="btn btn-primary mt-2">Submit</button>
            </div>
        </form>
    </div>
    @endsection
</x-admin-component>
