<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

//ambil data di url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id= $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])){

    //cek apakah data berhasil diubah atau tidak
    if(ubah($_POST) > 0){
        echo "
        <script>
        alert('data berhasil diubah!');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('data gagal diubah!');
        document.location.href = 'index.php';
        </script>
        ";
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah data mahasiswa</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <style>
    body { background-color: #f8f9fa; }

    </style>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container bg-white p-4 mt-4 rounded shadow" style="max-width: 800px;">
    <h2 class="mb-4 text-center">Ubah data mahasiswa</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
             <div>
                <label for="nim" class="form-label fw-bold">NIM :</label>
                <input type="text" name="nim" id="nim" required value="<?= $mhs["nim"]; ?>" class="form-control">
            </div>
            <div>
                <label for="nama" class="form-label fw-bold">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>" class="form-control">
            </div>
            <div>
                <label for="email" class="form-label fw-bold">Email :</label>
                <input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>" class="form-control">
            </div>
            <div>
                <label for="jurusan" class="form-label fw-bold">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>" class="form-control">
            </div>
            <div>
                <label for="gambar" class="form-label fw-bold" form-label fw-bold>Gambar :</label> <br>
                <img src="img/<?= $mhs['gambar']; ?>" width="60" class="mb-3"> <br>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary mt-4">Ubah Data</button>
            </div>
        

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>