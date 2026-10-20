<?php

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/M_Register.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Register.php");
    exit;
}

$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = strtolower(trim($_POST['role'] ?? ''));

$daftar_role = ['admin', 'petugas', 'owner'];

if (
    $nama_lengkap == '' ||
    $username == '' ||
    $password == '' ||
    !in_array($role, $daftar_role)
) {
    header("Location: ../View/Register.php?pesan=" .
        urlencode("Data pendaftaran belum lengkap"));
    exit;
}

// Memeriksa username melalui Model
if (cekUsername($koneksi, $username)) {
    header("Location: ../View/Register.php?pesan=" .
        urlencode("Username sudah digunakan"));
    exit;
}

// Menyimpan data melalui Model
$berhasil = simpanPengguna(
    $koneksi,
    $nama_lengkap,
    $username,
    $password,
    $role
);

if ($berhasil) {
    header("Location: ../View/Login.php?pesan=" .
        urlencode("Registrasi berhasil"));
    exit;
} else {
    header("Location: ../View/Register.php?pesan=" .
        urlencode("Registrasi gagal"));
    exit;
}

?>
