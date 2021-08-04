@extends('admin.layouts.app')
@section('title', 'Edit User | Admin')
@section('content')
<br>
<br>
<br>
<form action="{{route('admin-update-user')}}" method="POST">
@csrf
  <div class="mb-3">
    <label class="form-label">First Name</label>
    <input type="text" name="firstName" value="{{$user->firstName}}" class="form-control" >
    <input type="hidden" name="id" value="{{$user->id}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Last name</label>
    <input type="text" name="lastName" value="{{$user->lastName}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Middle Name(optional)</label>
    <input type="text" name="middleName" value="{{$user->middleName}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{$user->email}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">mobile</label>
    <input type="number" name="mobile" value="{{$user->mobile}}" class="form-control" >
  </div>

  <button type="button" class="btn btn-danger">Cancel</button>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection