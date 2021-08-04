<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Register | Author</title>
</head>
<body style="max-width: 500px;margin: auto;">
    <h2>Register as Author</h2>
    <br>
<form method="POST" action="{{ route('author-post-register')}}">
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
    <button type="submit">Submit</button>
    <button type="button">Cancel</button>
</form>

</body>
</html>