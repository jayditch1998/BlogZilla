@extends('author.layouts.app')
@section('title', 'Dashboard | Author')
@section('content')
<h1>Dashboard</h1>
<h5>Your Total Posts: {{$total_posts}}</h5><br>
<h5>Your Total Likes: {{$total_likes}}</h5><br>
<h5>Your Total Comments: {{$total_comments}}</h5><br>

<br>
<br>

@endsection