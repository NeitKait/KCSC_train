<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang ky</title>
</head>
<body>
    <form method="POST" action="register_submit.php">
        <div>
            <label for="username">username:</label>
            <input type="text"  placeholder="Enter username" name="username" required value="">            
        </div>
        <div>
            <label for="password">password:</label>
            <input type="password"  placeholder="Enter password" name="password" required value="">            
        </div>
        <div>
            <label for="repassword">repassword:</label>
            <input type="password"  placeholder="Enter repassword" name="repassword" required value="">            
        </div>
        <button type="submit" name="submit">Register</button>
        <button onclick="window.location.href = 'login.php';"> Login</button>

    </form>
</body>
</html>