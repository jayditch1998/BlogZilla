<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
</head>
<body>
    @foreach($posts as $post)
    <h3>{{$post->title}}</h3>
    <p>{{$post->body}}</p>
    <i>Like/s: <b>&nbsp({{$post->likes->where('is_like',1)->count()}})</b></i>
    
    <br>
    <i>By: {{$post->publisher}}</i>
    <br>
    <small>Posted: {{date('M d Y h:i a', strtotime($post->created_at));}}</small>
    <br>
    @if($post->likes->where('user_id', Auth::user()->id)->where('is_like',1)->count() < 1)
    <a href="{{route('like', $post->id)}}">Like</a>
    @else
    <a href="{{route('unlike', $post->id)}}">Unlike</a>
    @endif
    <input type="hidden" name="id" value="{{$post->id}}">
    &nbsp&nbsp&nbsp&nbsp
    <!-- <a href="#">Comments</a> -->
    <hr>
    @endforeach
</body>
</html>