<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
        <x-app-layout>
          <x-slot name="header">
             <title>作成</title>
          </x-slot>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      </head>
      <body>
          <h1>New Furniture </h1>
          <form action="/posts" method="POST">
              @csrf
          <div class="title">
              <h2>Title</h2>
              <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
              <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
          </div>
          <div class="image">
              <h2>Image</h2>
          </div>
          <div class="caption">
              <h2>Caption</h2>
              <textarea name="post[caption]" placeholder="説明">{{ old('post.caption') }}</textarea>
              <p class="caption__error" style="color:red">{{ $errors->first('post.caption') }}</p>
          </div>
              <input type="submit" value="store"/>
          </form>
          <div class="back">
              [<a href="/">back</a>]
          </div>
      </body>
       </x-app-layout>
</html>      
   
       
    