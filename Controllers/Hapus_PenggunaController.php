<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../View/Login.php");
    exit;
}

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: ../View/Login.php");
    exit;
}

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/M_Pengguna.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id']) || (int) $_GET['id'] < 1) {
    die("ID pengguna tidak valid.");
}

$model = new M_Pengguna($koneksi);
$berhasil = $model->hapusPengguna((int) $_GET['id']);

if ($berhasil) {
    header("Location: ../View/Pengguna.php?pesan=Data berhasil dihapus");
    exit;
}

die("Gagal menghapus pengguna.");
?>