<?php
namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
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
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required',
        ]);

        if(request()->hasFile('post_image')){
            $path = request()->file('post_image')->store('images');

            Artisan::call('storage:link');
            $filename = basename(Storage::url($path));
            $inputs['post_image'] = '/storage/images/' . $filename;
        }


        auth()->user()->posts()->create($inputs);

        Session::flash('post-create-message', 'The post '. '<b>'. $inputs['title'] .'</b>' .' has been added.');

        return redirect()->route('post.index');
    }

    public function index() {
        if (auth()->user()->roles()->first()->slug == "admin") {
            $posts = Post::paginate(5);
        } else {
            $posts = auth()->user()->posts()->paginate(5);
        }

        return view('admin.posts.index', compact('posts'));
    }

    public function destroy(Post $post) {
        $post->delete();

        Session::flash('post-delete-message', "The post ". '<b>'. $post->title .'</b>' ." has been deleted.");

        return back();

    }

    public function edit(Post $post) {

        return view('admin.posts.update', compact('post'));
    }

    public function update(Post $post) {
        $inputs = request()->validate([
            'title' => 'required|min:6|max:255',
            'body' => 'required',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (request()->hasFile('post_image')) {
            $path = request()->file('post_image')->store('images');

            Artisan::call('storage:link');
            $filename = basename(Storage::url($path));
            $inputs['post_image'] = '/storage/images/' . $filename;
        }

        $post->update($inputs);
        Session::flash('post-update-message', "The post ". '<b>'. $post->title .'</b>' ." has been deleted.");
        return redirect()->route('post.index', $post);
    }
}
