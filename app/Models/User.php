<?php

namespace App\Models;

use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() {
        parent::boot();

        static::created(function ($user) {
            $user->roles()->attach(Role::where('name','User')->first());
        });

    }

    public function setPasswordAttribute($value) {
        $this -> attributes['password'] = bcrypt($value);
    }
    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = asset($value);
    }
    public function getAvatarAttribute($value)
    {
        return asset($value);
    }

    public function posts() {
        return $this -> hasMany(Post::class);
    }

    public function roles() {
        return $this -> belongsToMany(Role::class);
    }

    public function permissions() {
        return $this -> belongsToMany(Permission::class);
    }

    public function userHasRole($role_name) {
        foreach ($this -> roles as $role) {
            if (strtolower($role_name) == strtolower($role->name))
                return true;
        }
        return false;
    }
}
