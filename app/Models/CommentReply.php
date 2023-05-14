<?php

namespace App\Models;

use App\Observers\CommentReplyObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'is_active',
        'author',
        'avatar',
        'email',
        'body'
    ];

    public function comment() {
        return $this->belongsTo(Comment::class);
    }

    protected static function boot()
    {
        parent::boot();

        CommentReply::observe(CommentReplyObserver::class);
    }
}
