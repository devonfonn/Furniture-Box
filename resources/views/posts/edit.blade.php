<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <x-app-layout>
         <x-slot name="header">
            <title>編集</title>
         </x-slot>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      </head>
      <body>
          <h1 class="title">編集画面</h1>
          <div class="content">
              <form action="/posts/{{ $post->id }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class='content__title'>
                      <h2>Title</h2>
                      <input type='text' name='post[title]' value="{{ $post->title }}">
                  </div>
                   <div class="image">
                     <h2>Image</h2>
                    @if (isset($post->image))
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="max-width: 200px;">
                        <p>{{ $post->image }}</p>
                    @else
                        <p>画像がありません。</p>
                    @endif
                     <label for="image">新しい画像を選択してください。</label>
                     <input type="file" name="post[image]" class="form-control-file" id="image" name="image" value="{{ $post->image }}">
                   </div>
                   <div class='content__caption'>
                     <h2>Caption</h2>
                      <input type='text' name='post[caption]' value="{{ $post->caption }}">
                    </div>
                      <input type="submit" value="保存">
              </form>
          </div>
    　</body>
    　 </x-app-layout>
    </html>