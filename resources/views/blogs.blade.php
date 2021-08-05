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
    
    <h3><a href="#">{{$post->title}}</a></h3>
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
    <p>"{{$comment->comment}}"<br> <small><b><i><u>- {{$comment->user_name}}</u></i></b></small> </p>
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