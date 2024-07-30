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
