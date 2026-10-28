<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

//cek apakah tombol submit sudah ditekan atau belum


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah data mahasiswa</title>
        <link href="css/styles.css" rel="stylesheet"/>
    <style>
    body { 
        background-color: #f8f9fa;
        

}

    </style>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
    if(isset($_POST["submit"])){

        //cek apakah data berhasil ditambahkan atau tidak
        if(tambah($_POST) > 0){
            echo "
            <script>
                Swal.fire({
                    title: 'data berhasil ditambahkan!',
                    icon: 'success',
                    draggable: true
                }).then(function() {
                document.location.href = 'index.php';
                });
            </script>
            ";
        }
    }
    
    ?>




    <div class="container bg-white p-4 mt-4 rounded shadow" style="max-width: 800px;">
    <h2 class="mb-4 text-center">Tambah data mahasiswa</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <div>
                <label for="nim" class="form-label fw-bold">NIM :</label>
                <input type="text" name="nim" id="nim" required class="form-control">
            </div>
            <div>
                <label for="nama" class="form-label fw-bold mt-2">Nama :</label>
                <input type="text" name="nama" id="nama" required class="form-control">
            </div>
            <div>
                <label for="email" class="form-label fw-bold mt-2">Email :</label>
                <input type="text" name="email" id="email" required class="form-control">
            </div>
            <div>
                <label for="jurusan" class="form-label fw-bold mt-2">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required class="form-control">
            </div>
            <div>
                <label for="gambar" class="form-label fw-bold mt-2">Gambar :</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Tambah Data</button>
            </div>
        </ul>

    </form>
    </div>
</body>
</html>