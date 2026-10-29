<?php
require 'functions.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Registrasi</title>
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php 
    if(isset($_POST["register"])){
    global $conn;
    if(registrasi($_POST) > 0){
        echo "
            <script>
                Swal.fire({
                    title: 'data berhasil ditambahkan!',
                    icon: 'success',
                    draggable: true
                });
            </script>
            ";
    }else {
        echo mysqli_error($conn);
    }


    

}
    ?>


    <div class="login-card">
    <div class="card shadow">
    <div class="card-header bg-dark text-white text-center py-3">
        <h2>Halaman Registrasi</h2>
    </div>

    <div class="card-body p-4">
    <form action="" method="post">

            <div>
                <label for="username" class="form-label fw-bold">Username :</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div>
                <label for="password" class="form-label fw-bold">Password :</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div>
                <label for="password2" class="form-label fw-bold">Konfirmasi Password :</label>
                <input type="password" name="password2" id="password2" class="form-control">
            </div>
            <div>
                <button type="submit" name="register" class="btn btn-primary w-100 fw-bold mt-3">Register!</button>
            </div>

    </form>
    </div>
    </div>
    </div>
    </div>
</body>
</html>