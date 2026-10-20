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

// Pastikan data dikirim melalui form
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Tambah_Area.php");
    exit;
}

// Ambil data dari form
$nama_area = trim($_POST['nama_area'] ?? '');
$kapasitas = filter_var(
    $_POST['kapasitas'] ?? '',
    FILTER_VALIDATE_INT
);

// Validasi data
if ($nama_area == '' || $kapasitas === false ||
    $kapasitas === null || $kapasitas < 1) {
    header("Location: ../View/Tambah_Area.php?pesan=Data tidak valid");
    exit;
}

// Panggil Model
$model = new M_Area($koneksi);
$simpan = $model->tambahArea($nama_area, $kapasitas);

// Hasil proses
if ($simpan) {
    header("Location: ../View/Area_Parkir.php?pesan=Area berhasil ditambahkan");
    exit;
} else {
    die("Gagal menambahkan area.");
}