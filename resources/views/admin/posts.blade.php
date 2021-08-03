<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Posts</title>
</head>
<body>
<a href="{{route('admin-add-post')}}" class="btn btn-outline-secondary">Upload Post</a><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->body}}</td>
      <td><a href="{{route('admin-edit-post', $post->id)}}" class="btn btn-primary btn-sm">Edit</a>
      <a href="{{route('admin-delete-post', $post->id)}}" class="btn btn-primary btn-sm">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    });
</script>
</html>