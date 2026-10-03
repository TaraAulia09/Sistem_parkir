<?php

session_start();

if (
    !isset($_SESSION['role']) ||
    strtolower($_SESSION['role']) != 'admin'
) {
    header("Location: ../View/Login.php");
    exit;
}

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/KendaraanModel.php';


// Pastikan data dikirim dari form
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Tambah_Kendaraan.php");
    exit;
}


// Ambil ID user dari Admin yang sedang login
$id_user = $_SESSION['id_user'];


// Ambil data dari form
$plat_nomor = $_POST['plat_nomor'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$warna = $_POST['warna'];
$pemilik = $_POST['pemilik'];


// Buat objek Model
$kendaraanModel = new KendaraanModel($koneksi);


// Simpan kendaraan
$simpan = $kendaraanModel->tambah(
    $id_user,
    $plat_nomor,
    $jenis_kendaraan,
    $warna,
    $pemilik
);


if ($simpan) {

    header("Location: ../View/Kendaraan.php");
    exit;

} else {

    die("Gagal menambahkan kendaraan.");

}

?>