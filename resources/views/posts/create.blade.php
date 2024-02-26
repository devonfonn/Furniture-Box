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
          <form action="/posts" method="POST" enctype="multipart/form-data" id="furniture-form">
              @csrf
              <div class="title">
                  <h2>Title</h2>
                  <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                  <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
              </div>
              <div class="category">
                  <h2>Category</h2>
                  <select name="post[category_id]">
                      @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="image">
                  <h2>Image</h2>
                  <label for="image">画像を選択してください</label>
                  <input type="file" name="post[image]" class="form-control-file" id="image" name="image">
              </div>
              <div class="caption">
                  <h2>Caption</h2>
                  <textarea name="post[caption]" placeholder="説明">{{ old('post.caption') }}</textarea>
                  <p class="caption__error" style="color:red">{{ $errors->first('post.caption') }}</p>
              </div>
              <input type="submit" value="store"/>
          </form>
          <script>
              document.getElementById('furniture-form').addEventListener('submit', function(event) {
                var imageInput = document.getElementById('image');
                if (!imageInput.files || imageInput.files.length === 0) {
                    event.preventDefault(); // フォームの送信をキャンセル
                    alert('コミュニティ画像を選択してください。');
                }
            });
          </script>
          <div class="back">
              [<a href="/">back</a>]
          </div>
      </body>
       </x-app-layout>
</html>      
   
       
    