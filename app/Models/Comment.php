<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
     public function user()
    {
        return $this->hasMany(User::class);
    }
    
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    
    protected $fillable = [
       'id',
       'comment',
       'user_id',
       'post_id'
       ];
}