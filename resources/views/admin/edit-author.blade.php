@extends('admin.layouts.app')
@section('title', 'Edit Author | Admin')
@section('content')
<br>
<br>
<br>
<form action="{{route('admin-update-author')}}" method="POST">
@csrf
  <div class="mb-3">
    <label class="form-label">First Name</label>
    <input type="text" name="firstName" value="{{$author->firstName}}" class="form-control" >
    <input type="hidden" name="id" value="{{$author->id}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Last name</label>
    <input type="text" name="lastName" value="{{$author->lastName}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Middle Name(optional)</label>
    <input type="text" name="middleName" value="{{$author->middleName}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{$author->email}}" class="form-control" >
  </div>

  <div class="mb-3">
    <label class="form-label">mobile</label>
    <input type="number" name="mobile" value="{{$author->mobile}}" class="form-control" >
  </div>

  <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
@endsection