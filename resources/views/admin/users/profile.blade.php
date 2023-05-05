<x-admin-component>
    @section('content')

        <h1>Profile of {{$user -> name}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img height="150px" class="img-profile rounded-circle" src="{{$user -> avatar}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" name="avatar">
                        @error('avatar')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control @error('username') is-invalid @endif"
                               id="username"
                               value="{{$user->username}}"
                        >
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @endif"
                                   id="name"
                                   value="{{$user->name}}"
                            >
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                               name="email"
                               class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                               id="email"
                               value="{{$user->email}}"
                       >
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                               id="password"
                        >
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password"
                               name="confirmPassword"
                               class="form-control {{$errors->has('confirmPassword') ? 'is-invalid' : ''}}"
                               id="confirmPassword"
                        >
                        @error('confirmPassword')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Option</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td><input type="checkbox"
                                            @foreach($user->roles as $user_role)
                                                @if($user_role->slug == $role->slug)
                                                    checked
                                                @endif
                                            @endforeach


                                        ></td>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form action="{{route('user.role.attach', $user)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{$role->id}}">
                                                <button type="submit" class="btn btn-primary"
                                                @if($user->roles->contains($role))
                                                    disabled
                                                @endif
                                                >Attach</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('user.role.detach', $user)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{$role->id}}">
                                                <button type="submit" class="btn btn-danger"
                                                @if(!$user->roles->contains($role))
                                                    disabled
                                                @endif
                                                >Detach</button>
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


    @endsection
</x-admin-component>
