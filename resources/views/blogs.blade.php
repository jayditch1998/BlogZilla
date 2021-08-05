<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Blogs</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('logout')}}">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    @foreach($posts as $post)
    
    <h3><a href="{{route('view', $post->id)}}">{{$post->title}}</a></h3>
    @if($post->img)
    <img style="width: 300px;height: 300px;" id="blah" src="{{asset($post->img)}}" alt="image will display here" /><br>
    @endif
    <p>{{$post->body}}</p>
    
    <!-- <i>Comments/s: <b>&nbsp(0)</b></i> -->
    
    <br>
    <i>By: {{$post->author}}</i>
    <br>
    <small>Posted: {{date('M d Y h:i a', strtotime($post->created_at));}}</small>
    <br>
    @if($post->likes->where('user_id', Auth::user()->id)->where('is_like',1)->count() < 1)
    <a href="{{route('like', $post->id)}}">Like</a>
    @else
    <a href="{{route('unlike', $post->id)}}">Unlike</a>&nbsp
    @endif
    <input type="hidden" name="id" value="{{$post->id}}">
    &nbsp&nbsp&nbsp&nbsp
    <!-- <a href="#">Comments</a> -->
    <br>
    <br>
    <i>Like/s: <b>&nbsp({{$post->likes->where('is_like',1)->count()}})</b></i>&nbsp&nbsp&nbsp&nbsp
    <i>Comments: <b>({{$post->comments->count()}})</b></i><br>
    @foreach($post->comments as $comment)
    
    <p><b><u>{{$comment->user_name}}</u></b>: <br>
    <small><i>{{date('M d Y h:i a', strtotime($comment->created_at));}}</i></small>
    <br>
    "<i>{{$comment->comment}}"</i><br> </p>
    @endforeach
    
    <br>
    <form action="{{route('comment', $post->id)}}">
        <textarea placeholder="Comment..." name="comment" id="" cols="50" rows="5"></textarea><br>
        <button type="submit">Comment</button>
    </form>
    <hr>
    @endforeach
</body>
</html>