@extends('admin.layouts.app')
@section('title', 'Users | Admin')
@section('content')
<H1>Users</H1>
<a href="{{route('admin-add-user')}}" class="btn btn-outline-secondary">Add User</a><br>
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
    @foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->firstName}} {{$user->lastName}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->mobile}}</td>
      <td>{{$user->status}}</td>
      <td>{{$user->lastLogin}}</td>
      <td><a href="{{route('admin-edit-user', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
      <a href="{{route('admin-delete-user', $user->id)}}" class="btn btn-primary btn-sm">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection