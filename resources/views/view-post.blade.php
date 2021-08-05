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
<br>
<br>
<br>
@if($post->img)
<img style="width: 300px;height: 300px;" id="blah" src="{{asset($post->img)}}" alt="image will display here" />
@endif
<br>
<h1>{{$post->title}}</h1> <br>
tex{{$post->body}}  <br>
Author : <i>{{$post->author}}</i>  <br>
Date : {{date('M d Y h:i a', strtotime($post->created_at));}}  <br><br>
<i>Like/s: <b>&nbsp({{$post->likes->where('is_like',1)->count()}})</b></i>&nbsp&nbsp&nbsp&nbsp
    <i>Comments: <b>({{$post->comments->count()}})</b></i><br>
    @foreach($post->comments as $comment)
    
    <p><b><u>{{$comment->user_name}}</u></b>: <br>
    <small>{{date('M d Y h:i a', strtotime($comment->created_at));}}</small><br>
    "<i>{{$comment->comment}}"</i><br> </p>
    @endforeach
 <hr>
    <form action="{{route('comment', $post->id)}}">
        <textarea placeholder="Comment..." name="comment" id="" cols="50" rows="5"></textarea><br>
        <button type="submit">Comment</button>
    </form>
<br><br>
<a class="btn btn-danger" href="{{ url()->previous() }}">Back</a>

<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!-- <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script> -->
<script type="text/javascript">
	 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</body>
</html>