<?php
namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function show(Post $post) {
        return view('blog-post', compact('post'));
    }
    public function create() {
        return view ('admin.posts.create');
    }
    public function store() {

        $inputs = request() -> validate([
            'title' => 'required | min:6 | max:255',
            'post_image' => 'file:image',
            'body' => 'required',
        ]);

        if(request()->hasFile('post_image')){
            $path = request()->file('post_image')->store('public/images');

            Artisan::call('storage:link');
            $filename = basename(Storage::url($path));
            $inputs['post_image'] = $filename;
        }


        auth()->user()->posts()->create($inputs);
        return back();
    }
}
