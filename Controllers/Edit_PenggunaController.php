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
  
$model = new M_Pengguna($koneksi);  
  
// Pastikan permintaan berasal dari formulir POST  
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {  
    header("Location: ../View/Pengguna.php");  
    exit;  
}  
  
// Periksa ID pengguna  
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);  
  
if (!$id || $id < 1) {  
    die("ID pengguna tidak valid.");  
}  
  
// Ambil data formulir  
$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');  
$username     = trim($_POST['username'] ?? '');  
$password     = $_POST['password'] ?? '';  
$role         = strtolower(trim($_POST['role'] ?? ''));  
  
// Validasi input  
if (  
    $nama_lengkap === '' ||  
    $username === '' ||  
    $password === '' ||  
    !in_array($role, ['admin', 'petugas', 'owner'], true)  
) {  
    die("Data pengguna belum lengkap atau role tidak valid.");  
}  
  
// Jalankan proses edit melalui Model  
$berhasil = $model->editPengguna(  
    $id,  
    $nama_lengkap,  
    $username,  
    $password,  
    $role  
);  
  
if ($berhasil) {  
    header("Location: ../View/Pengguna.php");  
    exit;  
}  
  
die("Gagal mengubah data pengguna.");  
  
