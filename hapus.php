<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahan html untuk sweetalert</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
    <?php  
    if(hapus($id) > 0){
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'data berhasil dihapus!',
                    icon: 'success',
                    draggable: true
                }).then(function() {
                document.location.href = 'index.php';
                });
            </script>
            ";
} else {
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'data gagal dihapus!',
                    icon: 'error',
                    draggable: true
                }).then(function() {
                document.location.href = 'index.php';
                });
            </script>
            ";
}
?>
</body>
</html>
