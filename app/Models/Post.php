<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function getPaginateByLimit(int $limit_count = 5)
   {
       return $this->orderby('updated_at', 'DESC')->paginate($limit_count);
   }
   
   public function store(Request $request)
   {
       $request->validate([
           'post.title' => 'required',
           'post.image' => 'required|image',
           'post.caption' => 'required',
           ]);
   }
   
    protected $fillable = [
       'title',
       'image',
       'caption',
       ];
}



