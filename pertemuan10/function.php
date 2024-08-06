<?php
$db = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $db;
    // ambil data dari tabel mahasiwa / query data mahasiswa
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    global $db;

    // ambil data dari tiap elemen post dan sanitasi input
    $nim = mysqli_real_escape_string($db, $data["nim"]);
    $nama = mysqli_real_escape_string($db, $data["nama"]);
    $email = mysqli_real_escape_string($db, $data["email"]);
    $jurusan = mysqli_real_escape_string($db, $data["jurusan"]);
    // upload gambar
    $gambar = upload();

    if (!$gambar) {
        return false;
    }
    // query insert data mahasiswa
    $query = "INSERT INTO mahasiswa (nim, nama, email, jurusan, gambar) VALUES ('$nim', '$nama', '$email', '$jurusan', '$gambar')";

    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($db, $query)) {
        return true;
    } else {
        return mysqli_error($db);
    }
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar di opload
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu')
        <script/>";
        return false;
    }

    // cek apakah yang diopload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Format gambar yang diperbolehkan hanya.jpg,.jpeg,.png')
        <script/>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // pindahkan gambar ke folder img
    if (!move_uploaded_file($tmpName, 'img/' . $namaFileBaru)) {
        echo "<script>
        alert('Gagal mengupload gambar');
        </script>";
        return false;
    }

    return $namaFileBaru;
}

function hapus($id)
{
    global $db;
    // Sanitasi input ID
    $id = mysqli_real_escape_string($db, $id);
    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM mahasiswa WHERE id = $id";
    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($db, $query)) {
        return true;
    } else {
        return mysqli_error($db);
    }
}

function ubah($data)
{
    global $db;

    // Ambil data dari tiap elemen post dan sanitasi input
    $id = mysqli_real_escape_string($db, $data["id"]);
    $nim = mysqli_real_escape_string($db, $data["nim"]);
    $nama = mysqli_real_escape_string($db, $data["nama"]);
    $email = mysqli_real_escape_string($db, $data["email"]);
    $jurusan = mysqli_real_escape_string($db, $data["jurusan"]);
    $gambarLama =  mysqli_real_escape_string($db, $data["gambarLama"]);

    // cek apakah user pilih gambar baru
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    // Query update data mahasiswa
    $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";

    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($db, $query)) {
        return true;
    } else {
        return mysqli_error($db);
    }
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR
    nim LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    ";
    return query($query);
}
