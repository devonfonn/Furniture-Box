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
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
     </x-app-layout>
</html>