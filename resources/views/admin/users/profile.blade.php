<x-admin-component>
    @section('content')

        <h1>Profile of {{$user -> name}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form action="" method="post">
                    @csrf
                    <div class="mb-4">
                        <img height="150px" class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               id="username"
                               value="{{$user->username}}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                               name="email"
                               class="form-control"
                               id="email"
                               value="{{$user->email}}"
                       >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="password"
                        >
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password"
                               name="confirmPassword"
                               class="form-control"
                               id="confirmPassword"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    @endsection
</x-admin-component>
