<?php
usleep(500000);
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
            WHERE
            nama LIKE '%$keyword%' OR
            nim LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
        ";
$mahasiswa = query($query);


?>

<div id="container" class="card-body table-responsive">
<table id="datatablesSimple" class="table table-bordered table-striped table-hover align-middle" border="1" cellpadding="10" cellspacing="0">
    <thead class="table-dark text-center">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
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
                <a class ="btn btn-danger" href="hapus.php?id=<?= $row["id"];?> " onclick="konfirmasi(event, this.href)">Hapus</a>
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