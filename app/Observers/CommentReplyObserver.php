<?php

namespace App\Observers;
use App\Models\CommentReply;

class CommentReplyObserver
{
    public function updated(CommentReply $reply){
        $is_active = $reply->is_active;
        if ($is_active) {
            session()->flash('reply-approve-message', 'Reply of user ' . '<b>' . $reply->author . '</b>' . ' has been approved.');
        } else {
            session()->flash('reply-unapprove-message', 'Reply of user ' . '<b>' . $reply->author . '</b>' . ' has been unapproved.');
        }
    }

    public function deleted(CommentReply $reply){
        $author = $reply->author;
        session()->flash('reply-delete-message', 'The post of author ' . '<b>' . $author . '</b>' . ' has been deleted.');

    }

    public function created() {
        session()->flash('reply-added-message', 'Reply has been added and waiting for being posted by admin.');
    }
}
