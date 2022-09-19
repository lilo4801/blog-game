<html>
<head>
    <title>Welcome to All Laravel</title>
</head>
<body>
<h1>Người dùng {{ $user->fullname  }} đã like  bài viết của bạn</h1>
<p><a href="{{route('posts.show',$post_id)}}">Link bài viết</a></p>
</body>
</html>
