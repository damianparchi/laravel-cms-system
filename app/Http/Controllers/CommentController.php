<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $comments = Comment::paginate(5);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $data = [
          'post_id' => $request->post_id,
          'author' => $user->name,
          'email' => $user->email,
          'body' => $request->body,
          'avatar' => $user->avatar,

        ];

        Comment::create($data);

        $request->session()->flash('comment-added-message', 'Comment has been added and waiting for being posted by admin.');

        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $comments = $post -> comments;

        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        $is_active = $request->has('approve') ? 1 : 0;
        $comment->update(['is_active' => $is_active]);

        if ($is_active) {
            return back()->with('comment-approve-message', 'Comment of user ' . '<b>' . $comment->author . '</b>' . ' has been approved.');
        } else {
            return back()->with('comment-unapprove-message', 'Comment of user ' . '<b>' . $comment->author . '</b>' . ' has been unapproved.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $author = $comment -> author;
        $comment -> delete();

        return back()->with('comment-delete-message','Comment of user ' . '<b>' . $author .'</b>' . ' has been deleted.');;
    }
}
