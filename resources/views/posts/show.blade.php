<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <x-app-layout>
            <x-slot name="header">
               <title>投稿</title>
            </x-slot>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
       <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a> 
        <div class="content">
            <div class="content__post">
                <h3>{{ $post->image }}</h3>
                <h3>説明</h3>
                <p>{{ $post->caption }}</p>    
            </div>
        </div>
        
        <!-- いいねボタン -->
       <div>
      @if($post->is_liked_by_auth_user())
        <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->favorite_user->count() }}</span></a>
      @else
        <a href="{{ route('post.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->favorite_user->count() }}</span></a>
      @endif
      </div>
       {{ $post->favorite_user->count() }}
       
        <!-- コメント -->
        @foreach($comments as $comment)
        <div>
            <p>{{ $comment->comment }}</p>
            <p>投稿日時: {{ $comment->created_at }}</p>
            <p>最終更新日時: {{ $comment->updated_at }}</p>
            
            <!-- コメントの削除フォーム -->
            <form action="{{ route('comments.delete', $comment->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
        @endforeach
        
        <form action="/comment/{{ $post->id }}" method="post">
        @csrf
        <textarea name="comment" rows="3" cols="50" placeholder="コメントを入力してください"></textarea>
        <button type="submit">コメントする</button>
        </form>
    
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
     </x-app-layout>
</html>