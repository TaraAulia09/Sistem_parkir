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

// Cek ID area
$id_area = filter_var(
    $_GET['id'] ?? '',
    FILTER_VALIDATE_INT
);

if ($id_area === false || $id_area === null || $id_area < 1) {
    header("Location: ../View/Area_Parkir.php");
    exit;
}

// Panggil Model
$model = new M_Area($koneksi);

// Cek apakah area sudah digunakan transaksi
if ($model->cekTransaksiArea($id_area)) {
    echo "<script>
        alert('Area tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        window.location.href='../View/Area_Parkir.php';
    </script>";
    exit;
}

// Hapus area melalui Model
$hapus = $model->hapusArea($id_area);

if ($hapus) {
    header("Location: ../View/Area_Parkir.php");
    exit;
} else {
    die("Gagal menghapus area.");
}

?>