<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
</head>
<body>
    <h2>Administrator | Login</h2>
<form method="post" action="{{route('admin-post-login')}}">
@csrf
<label>Email</label>
    <input type="text" name="email" placeholder="Enter Email">

<label>Password</label>
    <input type="password" name="password" placeholder="Enter Password">
    <button type="submit">Login</button
</form>
</body>
</html>