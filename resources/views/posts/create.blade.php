<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <title>作成</title>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      </head>
      <body>
          <h1>New Furniture </h1>
          <form action="/posts" method="POST">
              @csrf
          <div class="title">
              <h2>Title</h2>
              <input type="text" name="post[title]" placeholder="タイトル"/>
          </div>
          <div class="image">
              <h2>Image</h2>
          </div>
          <div class="caption">
              <h2>Caption</h2>
              <textarea name="post[caption]" placeholder="説明"></textarea>
          </div>
              <input type="submit" value="store"/>
          </form>
          <div class="footer">
              <a href="/">戻る</a>
          </div>
      </body>
</html>      
   
       
    