<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
<form method="post" action="{{route('author-post-login')}}">
@csrf
<label>Email</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" name="email" placeholder="Enter Email">
<br>
<br>
<label>Password</label>&nbsp&nbsp
    <input type="password" name="password" placeholder="Enter Password">
    <br>
    <br>
    <button type="submit">Login</button>
</form>
<a href="{{route('register')}}">Register</a>
</body>
</html>
