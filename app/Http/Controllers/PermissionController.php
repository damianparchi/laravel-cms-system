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
            'name' => ucfirst(request('name')),
            'slug' => Str::of(request('name'))->slug('-')
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

    public function update(Permission $permission) {

        $oldname = $permission -> name;

        $permission -> name = ucfirst(request('name'));
        $permission -> slug = str()->of(request('name'))->slug('-');

        if($permission->isDirty('name')) {
            $permission -> save();
            session()->flash('permissions-update-message', 'Permission ' . '<b>' . $oldname . '</b>' . ' has been updated to ' . '<b>' . $permission->name . '</b>.');
        } else {
            session()->flash('permissions-update-message', 'Nothing has been updated.');
        }

        return redirect('/admin/permissions');
    }
}
