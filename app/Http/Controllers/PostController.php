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
       // フォームからのデータを取得
    $input = $request['post'];

    // ファイルがアップロードされているかを確認
    if ($request->hasFile('image')) {
        // アップロードされたファイルの保存
        $imagePath = $request->file('image')->store('images');

        // 画像のパスを投稿データにセット
        $input['image'] = $imagePath;
    }
    // 投稿データをモデルに埋め込んで保存
    $post->fill($input)->save();

    // 投稿の詳細ページにリダイレクト
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
    
    public function search(Post $post, Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'like', '%'.$query.'%')
                     ->orWhere('caption', 'like', '%'.$query.'%')
                     ->get();
        return view('posts.search')->with(['posts' => $posts, 'query' => $query]);            
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}
