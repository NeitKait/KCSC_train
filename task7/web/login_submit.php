<?php

    session_start();
    require 'config.php';
    if(isset($_POST['submit']) && $_POST["username"] != "" && $_POST["password"]){
        $username= $_POST["username"];
        $password= $_POST["password"];
        $password= md5($password);
        $sql = "SELECT * FROM user WHERE username='$username' and password='$password' LIMIT 1";
        $result = mysqli_query($conn, $sql);
       if($result){
            $row = mysqli_fetch_assoc($result);
            var_dump($row);
            if( $row > 0){
                $_SESSION["user"]=$username; 
                echo "You are dang nhap thanh cong";
            }else{
                echo"<script> alert('sai username hoac pass');</script>;";
            }
        }
        

    }else{
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nice</title>
</head>
<body>
    <br>
    <button onclick="window.location.href = 'login.php';"> Login</button>

</body>
</html>