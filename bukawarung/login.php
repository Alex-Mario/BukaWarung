<?php 
    require("db.php");
    if(isset($_POST["submit"])){
        session_start();
        $user = mysqli_real_escape_string($conn,$_POST["user"]);
        $pass = mysqli_real_escape_string($conn,md5($_POST["pass"]));
        $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$user' and password = '$pass'");
        if(mysqli_num_rows($cek)===1){
            $d = mysqli_fetch_object($cek);
            $_SESSION['status_login'] = true;
            $_SESSION['a_global'] = $d; // admin global
            $_SESSION['id'] = $d->admin_id;
            header("location:dashboard.php");
        } else {
            echo "<script>alert('Password atau Username anda salah')</script>";
        } 
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bukawarung</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet"> 
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="login" class="btn">
        </form>
        
    </div>
</body>
</html>