<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class PermissionController extends Controller
{
    public function index() {

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Permission $permission) {

        request()->validate([
            'name' => ['required']
        ]);

        $permission->create([
            'name'=> ucfirst(request('name')),
            'slug'=> strtolower(request('name')),
        ]);

        return back();
    }

    public function delete(Permission $permission) {

        $permission->delete();

        return back();
    }

    public function edit(Permission $permission) {

        return view('admin.permissions.edit',  compact('permission'));
    }
}
