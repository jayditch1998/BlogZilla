@extends('admin.layouts.app')
@section('title', 'View Post | Admin')
@section('content')
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
Date : {{date('M d Y h:i a', strtotime($post->created_at));}}
<br>
    @if($post->likes->where('user_id', Auth::user()->id)->where('is_like',1)->count() < 1)
    <a href="{{route('admin-like', $post->id)}}">Like</a>
    @else
    <a href="{{route('admin-unlike', $post->id)}}">Unlike</a>&nbsp <br>
    @endif
    <br>
    <br>
<i>Like/s: <b>&nbsp({{$post->likes->where('is_like',1)->count()}})</b></i>&nbsp&nbsp&nbsp&nbsp
    <i>Comments: <b>({{$post->comments->count()}})</b></i><br>
    <hr>
    @foreach($post->comments as $comment)
    
    <p><b><u>{{$comment->user_name}}</u></b>: <br>
    <small>{{date('M d Y h:i a', strtotime($comment->created_at));}}</small><br>
    "<i>{{$comment->comment}}"</i><br> </p>
    @endforeach
    
    <form action="{{route('admin-comment', $post->id)}}">
        <textarea placeholder="Comment..." name="comment" id="" cols="50" rows="5"></textarea><br>
        <button type="submit">Comment</button>
    </form>
<br><br>
<a class="btn btn-danger" href="{{ url()->previous() }}">Back</a>
@endsection
@section('scripts')
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
@endsection