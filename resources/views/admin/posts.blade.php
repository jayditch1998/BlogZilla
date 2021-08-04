@extends('admin.layouts.app')
@section('title', 'Posts | Admin')
@section('content')
<h1>Posts</h1>
<a href="{{route('admin-add-post')}}" class="btn btn-outline-secondary">Upload Post</a><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Publisher</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->publisher}}</td>
      <td>{{$post->title}}</td>
      <td>{{$post->body}}</td>
      <td>{{date('M d Y h:i a', strtotime($post->created_at));}}</td>
      <td>
        <a href="{{route('admin-edit-post', $post->id)}}" class="btn btn-success btn-sm">View</a>
        <a href="{{route('admin-edit-post', $post->id)}}" class="btn btn-primary btn-sm">Edit</a>
        <a href="{{route('admin-delete-post', $post->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
@section('scripts')
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    });
</script>
@endsection