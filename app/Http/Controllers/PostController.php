<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\favorite_user;
use Auth;
use App\Http\Requests\PostRequest;



class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]);
    }
    
    public function show(Post $post, Comment $comments)
    {
        return view('posts.show')->with(['post' => $post, 'comments' => $comments->get()]);
    }
    
    public function like($id)
    {
      favorite_user::create([
       'post_id' => $id,
       'user_id' => Auth::id(),
    ]);

    session()->flash('success', 'You Liked the Reply.');

    return redirect()->back();
    }
    
     public function unlike($id)
      {
        $favorite_user = favorite_user::where('post_id', $id)->where('user_id', Auth::id())->first();
    
         // $favorite_user が見つかった場合のみ削除処理を行う
        if ($favorite_user) {
            $favorite_user->delete();
            session()->flash('success', 'You Unliked the Reply.');
        } else {
            session()->flash('error', 'You have not liked this post.');
        }
        
        return redirect()->back();
      }
    
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }
    
    public function store(Request $request, Post $post)
    {
            $input = $request['post'];
            if (!$input['image'] == null) {
            $post->image=$input['image'];
         }
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }  
    
    public function edit(Post $post)
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
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', '%'.$query.'%')
                     ->orWhere('caption', '%'.$query.'%')
                     ->get();
        return view('posts.search_results', compact('posts', 'query'));            
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}
