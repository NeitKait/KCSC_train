<?php
    session_start();
    if(!$_SESSION["user"]){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wow</title>
</head>
<body>
<button onclick="window.location.href = 'register.php';"> Register</button>
<button onclick="window.location.href = 'login.php';"> login</button>
</body>
</html>