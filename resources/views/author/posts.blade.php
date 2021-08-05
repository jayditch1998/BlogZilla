@extends('author.layouts.app')
@section('title', 'Manage Posts | Author')
@section('content')
<h1>Manage Posts</h1>
<a href="{{route('author-add-post')}}" class="btn btn-outline-secondary">Upload Post</a><br>
<table class="table">
  <thead>
    <tr>
    <th scope="col">#</th>
      <th scope="col"style="width:15%;">Title</th>
      <th scope="col" style="width:35%;">Description</th>
      <th scope="col"style="width:15%;">Date</th>
      <th scope="col">Likes</th>
      <th scope="col">Comments</th>
      <th scope="col" style="width:14%;">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->body}}</td>
      <td>{{date('M d Y h:i a', strtotime($post->created_at));}}</td>
      <td>{{$post->likes->where('is_like',1)->count()}}</td>
      <td>{{$post->comments->count()}}</td>
      <td>
        <a href="{{route('author-view-post', $post->id)}}" class="btn btn-success btn-sm">View</a>
        <a href="{{route('author-edit-post', $post->id)}}" class="btn btn-primary btn-sm">Edit</a>
        <a href="{{route('author-delete-post', $post->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
    </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection