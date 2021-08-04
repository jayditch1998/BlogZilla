@extends('admin.layouts.app')
@section('title', 'Authors | Admin')
@section('content')
<H1>Authors</H1>
<a href="{{route('admin-add-author')}}" class="btn btn-outline-secondary">Add Author</a><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Status</th>
      <th scope="col">Last Login</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($authors as $author)
    <tr>
      <th scope="row">{{$author->id}}</th>
      <td>{{$author->firstName}} {{$author->lastName}}</td>
      <td>{{$author->email}}</td>
      <td>{{$author->mobile}}</td>
      <td>{{$author->status}}</td>
      <td>{{$author->lastLogin}}</td>
      <td><a href="{{route('admin-edit-author', $author->id)}}" class="btn btn-primary btn-sm">Edit</a>
      <a href="{{route('admin-delete-author', $author->id)}}" class="btn btn-primary btn-sm">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection