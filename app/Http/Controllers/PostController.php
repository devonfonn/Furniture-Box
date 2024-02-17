<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/' . $post->id);
    }
    
    public function edit(Request $request, Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
         $input_post = $request['post'];
         $post->title=$input_post['title'];
         $post->caption=$input_post['caption'];
         if (!$input_post['image'] == null) {
             $post->image=$input_post['image'];
         }
         $post->save();
         return redirect('/');
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
