<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Service</title>
</head>
<body>
    <h1>Welcome to the User Service. Now you can do these actions:</h1>
    <ul>
        <li><a href="http://localhost:8000/api/v1/users/register">Register</a></li>
        <li><a href="http://localhost:8000/api/v1/users/login">Login</a></li>
        <li><a href="http://localhost:8000/api/v1/users">List users</a></li>
    </ul>
</body>
</html>
