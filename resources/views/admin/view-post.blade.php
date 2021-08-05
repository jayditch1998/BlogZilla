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
<h1>Title: {{$post->title}}</h1> <br>
Body : tex{{$post->body}}  <br>
Author : {{$post->author}}  <br>
Date : {{date('M d Y h:i a', strtotime($post->created_at));}}  <br><br>
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