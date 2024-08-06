<?php
// koneksi ke database
require "function.php";

$mahasiswa = query("SELECT * FROM mahasiswa");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php dasar</title>
</head>

<body>
    <a href="index2.php">
        <h1>Daftar Mahasiswa</h1>
    </a>

    <a href="tambah.php">Tambah Data Mahasiswa</a>

    <br>
    <br>
    <form action="" method="POST">
        <input type="text" name="keyword" id="keyword" placeholder="Masukkan kata kunci" autofocus required>
        <button type="submit" name="cari">Cari</button>
    </form>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><a href="ubah.php?id=<?= $row["id"] ?>">Ubah</a> |
                    <a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Apakah anda yakin?');">Hapus</a>
                </td>
                <td><img src="./img/<?= $row["gambar"] ?>" alt="foto" width="70px" height="70px"></td>
                <td> <?= $row["nim"] ?></td>
                <td> <?= $row["nama"] ?></td>
                <td> <?= $row["email"] ?></td>
                <td><?= $row["jurusan"] ?></td>

            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>

</html>