<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'category_id', 'user_id'];
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }
    
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    public function getCommentsCountAttribute() {
        return $this->comments->count();
    } 
    
}