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
require_once __DIR__ . '/../Models/M_Area.php';

// Pastikan data dikirim dari form
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Area_Parkir.php");
    exit;
}

// Ambil data dari form
$id_area = filter_var(
    $_POST['id_area_parkir'] ?? '',
    FILTER_VALIDATE_INT
);

$nama_area = trim($_POST['nama_area'] ?? '');

$kapasitas = filter_var(
    $_POST['kapasitas'] ?? '',
    FILTER_VALIDATE_INT
);

// Validasi data
if (
    $id_area === false || $id_area === null || $id_area < 1 ||
    $nama_area === '' ||
    $kapasitas === false || $kapasitas === null ||
    $kapasitas < 1
) {
    die("Data area tidak valid.");
}

// Panggil Model
$model = new M_Area($koneksi);

$ubah = $model->editArea(
    $id_area,
    $nama_area,
    $kapasitas
);

// Hasil proses
if ($ubah) {
    header("Location: ../View/Area_Parkir.php");
    exit;
} else {
    die("Gagal mengubah area.");
}

?>