@extends('author.layouts.app')
@section('title', 'Add Post | Author')
@section('content')
<br>
<br>
<h2>Add Post</h2>
<br>
<form action="{{route('author-post-add-post')}}" method="POST">
@csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Body</label>
    <textarea type="text" name="body" class="form-control" id="exampleInputPassword1" style="height:200px;"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
</form>
@endsection