<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
include 'function.php';
$id = $_GET["id"];

// Cek apakah ada parameter ID untuk dihapus
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $result = hapus($id);
    if ($result === true) {
        echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'index2.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus: $result');
        document.location.href = 'index2.php';
        </script>";
    }
}
