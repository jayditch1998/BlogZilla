@extends('admin.layouts.app')
@section('title', 'Edit Post | Admin')
@section('content')
<br>
<br>
<br>
<form action="{{route('admin-post-edit-post')}}" method="POST" enctype="multipart/form-data">
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

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" name="img" class="form-control" onchange="readURL(this);" accept=".png, .jpg, .jpeg">
    
    <img style="width: 300px;height: 300px;" id="blah" src="{{asset($post->img)}}" alt="image will display here" />
  </div>
  <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
  <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-success">Submit</button>
</form>
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