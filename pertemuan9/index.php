<?php
// koneksi ke database
$db = mysqli_connect("localhost", "root", "", "phpdasar");


// ambil data dari tabel mahasiwa / query data mahasiswa
$result = mysqli_query($db, "SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php dasar</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>

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
        <tr>
            <td>1</td>
            <td><a href="#">Ubah</a> |
                <a href="#">Hapus</a>
            </td>
            <td><img src="./img/download.jpg" alt="foto" width="70px" height="70px"></td>
            <td>210209501011</td>
            <td>Muhammad Alwi</td>
            <td>alwi3479@gmail.com</td>
            <td>teknik informatika</td>
        </tr>
    </table>
</body>

</html>