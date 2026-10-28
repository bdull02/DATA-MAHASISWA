<?php 
session_start();
require 'functions.php';

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    global $conn;
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id=$id");
    $row = mysqli_fetch_array($result);

    //cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
    
}


if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) === 1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){

            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if(isset($_POST['remember'])){
                //buat cookie
                
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center; 
        }   

    .login-card {
            width: 100%;
            max-width: 400px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="login-card">
    <div class="card shadow">
    <div class="card-header bg-dark text-white text-center py-3">
        <h1>Halaman Login</h1>
    </div>

    <div class="card-body p-4">
    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic;">username/password salah</p>
    
    <?php endif; ?>

    <form action="" method="post">

            <div>
                <label for="username" class="form-label fw-bold">Username :</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div>
                <label for="password" class="form-label fw-bold">Password :</label>
                <input type="text" name="password" id="password" class="form-control mb-3">
            </div>
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
                
            </div>
            <div>
                <button type="submit" name="login" class="btn btn-primary w-100 fw-bold mt-3">Login</button>
            </div>

    </form>
    </div>
    </div>
    </div>

</body>
</html>