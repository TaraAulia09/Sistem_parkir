<?php
$koneksi = mysqli_connect(
    "127.0.0.1",
    "root",
    "root",
    "Database_parkir",
    3306
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
