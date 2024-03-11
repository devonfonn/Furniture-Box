<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
       <meta charset="utf-8">
    　<title>Furniture</title>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
　</head>
      <body>
          <h1>Furniture Site</h1>
          
      <!-- 検索結果を表示 -->
        <h1>検索結果: "{{ $query }}"</h1>
        @if($posts->isEmpty())
            <p>該当する投稿が見つかりませんでした。</p>
        @else
            <ul>
                @foreach($posts as $post)
                    <li class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </li>
                    <!-- 必要に応じて他の投稿の情報も表示 -->
                @endforeach
            </ul>
        @endif
       </body>
</html>