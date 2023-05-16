<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $search = request()->query('search');
        if($search) {
            $categories = Category::where('name', 'LIKE', "%{$search}%")->paginate(5);
        } else {
            $categories = Category::paginate(5);
        }

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request) {
        request()->validate([
            'name' => ['required']
        ]);
        Category::create($request->all());
        session()->flash('admin.create',  'Category ' . '<b>' . $request->name . '</b>' . ' has been created.');

        return back();
    }

    public function destroy(Category $category) {
        $category->delete();
        session()->flash('admin.delete', 'Category ' . '<b>' . $category->name . '</b>' . ' has been deleted.');

        return back();
    }

    public function edit(Category $category) {

        return view('admin.categories.edit', compact('category'));
    }


    public function update(Category $category) {
        $category->update([
            'name'=>\request('name'),
        ]);
        session()->flash('admin.update', 'Category ' . '<b>' . $category->name . '</b>' . ' has been updated.');

        return redirect('admin/categories');
    }

}
