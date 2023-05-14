<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentReplyRequest;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class CommentRepliesController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies()->paginate(5);

        return view('admin.comments.replies.show', compact('replies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reply = CommentReply::findOrFail($id);
        $is_active = $request->has('approve') ? 1 : 0;
        $reply->update(['is_active' => $is_active]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        return back();
    }

    /**
     * Create the specified resource from storage.
     */
    public function createReply(CreateCommentReplyRequest  $request, Authenticatable $user) {
        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'body' => $request->body,
            'avatar' => $user->avatar,

        ];

        CommentReply::create($data);

        return back();
    }
}
