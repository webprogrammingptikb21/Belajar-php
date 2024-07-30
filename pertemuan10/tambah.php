<?php
// koneksi ke database
$db = mysqli_connect("localhost", "root", "", "phpdasar");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // ambil data dari tiap elemen post dan sanitasi input
    $nim = mysqli_real_escape_string($db, $_POST["nim"]);
    $nama = mysqli_real_escape_string($db, $_POST["nama"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $jurusan = mysqli_real_escape_string($db, $_POST["jurusan"]);
    $gambar = mysqli_real_escape_string($db, $_POST["gambar"]);

    // query insert data mahasiswa
    $query = "INSERT INTO mahasiswa (nim, nama, email, jurusan, gambar) VALUES ('$nim', '$nama', '$email', '$jurusan', '$gambar')";

    // eksekusi query dan cek apakah berhasil
    if (mysqli_query($db, $query)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan: " . mysqli_error($db) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="nim">NIM: </label>
                <input type="text" name="nim" id="nim" required>
            </li>
            <li>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required>
            </li>
            <li>
                <label for="jurusan">Jurusan: </label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar">Gambar: </label>
                <input type="text" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>

</html>