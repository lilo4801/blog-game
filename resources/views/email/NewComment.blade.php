<html>
<head>
    <title>Welcome to All Laravel</title>
</head>
<body>
<h1>Người dùng {{ $user->fullname  }} đã comment trong bài viết của bạn</h1>
<p><a href="{{route('posts.show',$post->id)}}">Link bài viết</a></p>
</body>
</html>
