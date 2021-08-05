@extends('admin.layouts.app')
@section('title', 'Dashboard | Admin')
@section('content')

<h1>Dashboard</h1>
<h5>Total Authors: {{$total_users}}</h5><br>
<h5>Total Users: {{$total_users}}</h5><br>
<br>
<br>
<h5>Total Posts: {{$total_posts}}</h5><br>
@endsection