<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request, Comment $comment, Post $post)
    {
       $input['comment'] = $request['comment']; 
       $input['post_id'] = $post->id;
       $input['user_id'] = Auth::id();
       $comment->fill($input)->save();
       return redirect('/posts/' . $post->id);
    }
    
    public function show(Comment $comment)
    {
        return response()->json($comment, 200);
    }
    
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'comment' => $request->input('comment'),
            ]);
            
        return response()->json($comment, 200);
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/');
    }
}