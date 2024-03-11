<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function getPaginateByLimit(int $limit_count = 5)
   {
       return $this::with('category')->orderby('updated_at', 'DESC')->paginate($limit_count);
   }
   
   public function store(Request $request)
   {
       $request->validate([
           'post.title' => 'required',
           'post.image' => 'required|image',
           'post.caption' => 'required',
           ]);
   }
   
   public function category()
   {
       return $this->belongsTo(Category::class);
   }
   
   public function comment()
   {
       return $this->belongsTo(Comment::class);
   }
   
   public function favorite_user()
{
    return $this->hasMany(favorite_user::class, 'post_id');
}

 public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->favorite_user as $favorite_user) {
      array_push($likers, $favorite_user->user_id);
    }

    if (in_array($id, $likers)) {
      return true;
    } else {
      return false;
    }
  }
  
  
    protected $fillable = [
       'title',
       'image',
       'caption',
       'category_id'
       ];
}



