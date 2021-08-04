<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Register</title>
</head>
<body style="max-width: 500px;margin: auto;">
    <h2>Register</h2>
    <br>
<form method="POST" action="{{ route('post-register')}}">
    @csrf    
<!-- <label for="">First Name</label> -->
    <input placeholder="First Name" name="firstName" type="text" />
    <br>
    <br>
    <!-- <label for="">Last Name</label> -->
    <input placeholder="Last Name" name="lastName" type="text" />
    <br>
    <br>
    <!-- <label for="">Middle Name</label> -->
    <input placeholder="Middle Name (optional)" name="middleName" type="text" />
    <br>
    <br>
    <!-- <label for="">First Name</label> -->
    <input placeholder="Email"name="email" type="email" />
    <br>
    <br>
    <!-- <label for="">First Name</label> -->
    <input placeholder="Mobile" name="mobile" type="number" />
    <br>
    <br>
    <!-- <label for="">First Name</label> -->
    <input placeholder="Password" name="password" type="password" />
    <br>
    <br>
    <select name="role" id="">
        <option> Select Role </option>
        <option value="3">User</option>
        <option value="2">Author</option>
    </select>
    <br>
    <br>
    <button type="submit">Submit</button>
    <a href="{{ url()->previous() }}">Cancel</a>
</form>

</body>
</html>