<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index() {

        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function store() {

        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => ucfirst( request('name')),
            'slug' => strtolower(request('name')),
        ]);

        return back();
    }

    public function delete(Role $role) {
        $role -> delete();

        Session::flash('role-delete-message', 'The role '. '<b>'. $role->name .'</b>' .' has been deleted.');
        return back();
    }
}
