<?php

$host = "127.0.0.1";
$user = "root";
$pass = "root";
$db   = "Database_parkir";
$port = 3306;

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil!";

?>