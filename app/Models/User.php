<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $fillable = [ 'name', 'email', 'password', 'isAdmin'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }
}