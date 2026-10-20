<?php
session_start();

// Cek login
if (!isset($_SESSION['role'])) {
    header("Location: ../View/Login.php?pesan=Silakan Login Dulu!");
    exit;
}

// Hanya admin yang boleh menambah pengguna
if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: ../View/Login.php?pesan=Anda Bukan Admin!");
    exit;
}

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/M_Pengguna.php';

// Proses hanya jika form dikirim dengan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../View/Pengguna.php");
    exit;
}

// Ambil data dari form
$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$username     = trim($_POST['username'] ?? '');
$password     = $_POST['password'] ?? '';
$role         = strtolower(trim($_POST['role'] ?? ''));

// Validasi data
if (
    $nama_lengkap === '' ||
    $username === '' ||
    $password === '' ||
    !in_array($role, ['admin', 'petugas', 'owner'], true)
) {
    die("Data pengguna belum lengkap atau role tidak valid.");
}

// Panggil Model
$model = new M_Pengguna($koneksi);

$berhasil = $model->tambahPengguna(
    $nama_lengkap,
    $username,
    $password,
    $role
);

if ($berhasil) {
    header("Location: ../View/Pengguna.php?pesan=Data berhasil ditambahkan");
    exit;
}

die("Gagal menambahkan pengguna. Periksa kembali data dan database.");
?>