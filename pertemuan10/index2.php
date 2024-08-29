<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
// koneksi ke database
require "function.php";


// paginations
// konfigurasi
$jumlahdataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahdataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahdataPerhalaman * $halamanAktif) - $jumlahdataPerhalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahdataPerhalaman");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

// cek jika data kosong
if (empty($mahasiswa)) {
    echo "<script>
     alert('Data tidak ditemukan');
     document.location.href = 'index2.php';
     </script>";
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
    <a href="logout.php">Logout</a>
    <br>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br>
    <br>
    <form action="" method="POST">
        <input type="text" name="keyword" id="keyword" placeholder="Masukkan kata kunci" autofocus required>
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
    </form>
    <!-- navigasi -->
    <?php if ($halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&lt;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:red"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&gt;</a>
    <?php endif; ?>
    <br>
    <div id="container">
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
    </div>
    <script src="js/script.js"></script>
</body>

</html>