<x-admin-component>
    @section('content')
        <h1>Update permission</h1>
        <div class="row">
                <div class="col-sm-3">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{$permission->name}}"
                           class="form-control">
                    <button type="submit" class="mt-2 btn btn-primary">Update</button>
                </div>
        </div>
    @endsection
</x-admin-component>
