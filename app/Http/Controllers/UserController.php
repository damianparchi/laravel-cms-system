<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user) {
        return view('admin.users.profile', compact('user'));
    }

    public function update(User $user) {

        $inputs = request()->validate([
            'username'=>'required|max:255|string|alpha_dash',
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'avatar' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(request('avatar')) {
            $path = request()->file('avatar')->store('images');

            Artisan::call('storage:link');
            $filename = basename(Storage::url($path));
            $inputs['avatar'] = '/storage/images/' . $filename;
        }

        $user -> update($inputs);

        return back();


    }

    public function index() {
        $users = User::paginate(5);

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user) {

        $user -> delete();

        session()->flash('user-delete-message', '<b>' . $user->username . '</b>' . ' has been deleted');

        return back();

    }
}
