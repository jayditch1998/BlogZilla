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
      <td>
      @if($user->status == "active")
          <a class="btn btn-success btn-sm" title="Active" href="{{route('admin-deactivate-user', $user->id)}}">Actived</a>
        @else
        <a class="btn btn-danger btn-sm" title="Not Active" href="{{route('admin-activate-user', $user->id)}}">Deactivated</a>
        @endif
      </td>
      <td>{{date('M d Y h:i a', strtotime($user->lastLogin));}}</td>
      <td><a href="{{route('admin-edit-user', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
      <a href="{{route('admin-delete-user', $user->id)}}" class="btn btn-primary btn-sm">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection