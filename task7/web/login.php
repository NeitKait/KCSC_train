<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dang nhap</title>
</head>
<body>
    <form method="POST" action="login_submit.php" >
        <div>
            <label for="">username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="">password</label>
            <input type="password" name="password">
        </div>
        <button type="submit" name="submit">Login</button>
        
    </form>
    <button onclick="window.location.href = 'register.php';"> Register</button>
</body>
</html>