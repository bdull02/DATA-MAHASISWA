<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}



require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

//pagination
//konfigurasi
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa "));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
//halaman = 2,  awal data = 3
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

//tombol cari di tekan
if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Admin</title>

    <link rel="stylesheet" href="css/styles.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function konfirmasi(event, url) {
            event.preventDefault(); // Mencegah link langsung pindah
            
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Kamu tidak akan bisa mengembalikan data ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

    <style>

    body { background-color: #f8f9fa; }
    .loader{
        width: 100px;
        position: absolute;
        top: 195px;
        left: 330px;
        z-index: -1;
        display: none;
    }

    @media print{
        .logout, .tambah, .form-cari, .aksi{
            display: none;
        }
        
    }
    </style>

    <script src="js/jquery-4.0.0.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark shadow mb-4">
        <div class=" mt-3 mb-4 ms-auto me-3">
            <a href="logout.php" class="logout btn btn-outline-light btn-sm " >Logout</a> 
        </div>
    </nav>

    
    <div class="container bg-white p-4 mt-4 rounded shadow">
    <h1 class="mb-3">Daftar Mahasiswa</h1>

    <a href="tambah.php" class="tambah btn btn-primary">Tambah data mahasiswa</a>
    <a href="cetak.php" target="_blank" class="btn btn-secondary">Cetak</a>
    <br><br>

    <form action="" method="post" class="form-cari d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <input class="form-control" type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

        <img src="img/loading-buffering.gif" class="loader" id="">
    </form>

    <br><br>
        <!-- navigasi -->
    <?php if($halamanAktif > 1) :?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>" class="btn btn-outline-primary btn-sm">&laquo;</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i ?>" style="font-weight:bold; color: white;" class="btn btn-primary btn-sm fw-bold"><?= $i ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i ?>" class="btn btn-outline-primary btn-sm"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if($halamanAktif < $jumlahHalaman) :?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>" class="btn btn-outline-primary btn-sm">&raquo;</a>
    <?php endif; ?>
    
    <br><br>

    <div id="container" class="card-body table-responsive">
    <table id="datatablesSimple" class="table table-bordered table-striped table-hover align-middle" border="1" cellpadding="10" cellspacing="0">
        <thead class="table-dark text-center">
        <tr>
            <th>No.</th>
            <th class="aksi">Aksi</th>
            <th>Gambar</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        </thead>
        
        <?php $i = 1;?>
        <?php foreach($mahasiswa as $row) : ?>
        <tr>
            <td class="text-center"><?= $i; ?></td>
            <td class="aksi">
                <a class ="btn btn-warning" href="ubah.php?id=<?= $row["id"];?>">Ubah</a> 
                <a class ="btn btn-danger" href="hapus.php?id=<?= $row["id"];?> " onclick="konfirmasi(event, this.href)" >Hapus</a>
            </td>
            <td class="text-center"><img src="img/<?= $row["gambar"];?>" width="50" class="rounded"></td>
            <td><?= $row["nim"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>

        <?php endforeach; ?>
    </table>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>