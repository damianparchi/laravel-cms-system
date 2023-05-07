<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'post_image',
        'body'
    ];


    public function user() {
        return $this -> belongsTo(User::class);
    }

    //mutator (persist before added to database)
    public function setPostImageAttribute($value) {
        $this -> attributes['post_image'] = asset($value);
    }

    //accessor
    public function getPostImageAttribute($value) {
        return asset($value);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
