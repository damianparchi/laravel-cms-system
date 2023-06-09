<x-admin-component>
    @section('content')
        <h1>Update permission</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permissions.update', $permission->id)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{$permission->name}}"
                           class="form-control">
                    <button type="submit" class="mt-2 btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-component>
