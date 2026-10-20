<?php

session_start();

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/M_Login.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Login.php");
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$data = loginUser($koneksi, $username, $password);

if ($data) {

    $_SESSION['id_user'] = $data['Id_user'];
    $_SESSION['username'] = $data['Username'];
    $_SESSION['role'] = $data['Role'];

    $role = strtolower($data['Role']);

    if ($role == 'admin') {

        header("Location: ../View/Admin.php");
        exit;

    } elseif ($role == 'petugas') {

        header("Location: ../View/Petugas.php");
        exit;

    } elseif ($role == 'owner') {

        header("Location: ../View/Owner.php");
        exit;

    } else {

        session_destroy();
        header("Location: ../View/Login.php?pesan=Role tidak dikenali");
        exit;

    }

} else {

    header("Location: ../View/Login.php?pesan=Username atau password salah");
    exit;

}

?>
