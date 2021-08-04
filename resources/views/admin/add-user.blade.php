@extends('admin.layouts.app')
@section('title', 'Add User | Admin')
@section('content')
<br>
<br>
<br>
<form action="{{route('admin-post-add-user')}}" method="POST">
@csrf
  <div class="mb-3">
    <label class="form-label">First Name</label>
    <input type="text" name="firstName" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Last name</label>
    <input type="text" name="lastName" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Middle Name(optional)</label>
    <input type="text" name="middleName" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">mobile</label>
    <input type="number" name="mobile" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Password | Default = 123456</label>
    <input type="text" value ="123456" name="password" class="form-control" >
  </div>

  <button type="button" class="btn btn-danger">Cancel</button>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection