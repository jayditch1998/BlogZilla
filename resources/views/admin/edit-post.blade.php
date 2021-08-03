@extends('admin.layouts.app')
@section('title', 'Add Post | Admin')
@section('content')
<br>
<br>
<br>
<form action="{{route('admin-post-edit-post')}}" method="POST">
@csrf
  <div class="mb-3">
      <input type = "hidden" value="{{$post->id}}" name="id">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->title}}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Body</label>
    <textarea type="text" name="body" class="form-control" id="exampleInputPassword1" style="height:200px;">{{$post->body}}</textarea>
  </div>
  <button type="button" class="btn btn-danger">Cancel</button>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection