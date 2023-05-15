<?php

namespace App\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Sluggable configuration.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'title',
        'post_image',
        'body',
		'slug'
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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_posts');
    }

    public function sluggable(): array{
        return [
            'slug' => [
                'source' => 'title',
                'unique' => true
            ]
        ];
    }
}
