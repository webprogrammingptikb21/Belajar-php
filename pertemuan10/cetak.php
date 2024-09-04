<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
    <link rel="stylesheet" href="./css/print.css">
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
     <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
            </tr>';
$i = 1;

foreach ($mahasiswa as $row) {
    $html .= '<tr>
                    <td>' . $i++ . '</td>
                    <td><img src="img/' . $row['gambar'] . '" alt="Gambar" width="50"></td>
                    <td>' . $row['nim'] . '</td>
                    <td>' . $row['nama'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['jurusan'] . '</td>
                </tr>';
}
$html .=  '</table>
</body>
</html>';
// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('daftar-mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);
