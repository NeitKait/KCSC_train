<?php
    require 'config.php';
    if(isset($_POST["submit"]) && $_POST["username"]!=""){
        $username= $_POST["username"];
        $password= $_POST["password"];
        $repassword= $_POST["repassword"];
         if($password != $repassword){
            header("location: register.php");
         }
         echo "Dang ky thanh cong";
         $sql = "SELECT * FROM user WHERE username='$username'";
         $old = mysqli_query($conn, $sql);
         $password = md5($password);
         if(mysqli_num_rows($old) > 0){
            header("location: register.php");
         }
         $sql = "INSERT INTO user (id,username,password) VALUES ('','{$username}','{$password}')";
         mysqli_query($conn, $sql);
    }else{
        header("location: register.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chuc mung</title>
</head>
<body>
    <form action="login.php">
    <button type="summit" name="submit">dang nhap</button>
    </form>
    
</body>
</html>