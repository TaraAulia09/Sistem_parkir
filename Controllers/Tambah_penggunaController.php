<?php

require_once __DIR__ . '/../Config/Koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_lengkap = $_POST['nama_lengkap'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $role         = $_POST['role'];

    // Status aktif: 1 = aktif
    $status_aktif = 1;

    // Cek username
    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM Tabel_user WHERE Username='$username'"
    );

    if (!$cek) {
        die("Query cek gagal: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($cek) > 0) {
        die("Username sudah digunakan. Silakan gunakan username lain.");
    }

    // Simpan data pengguna
    $query = mysqli_query(
        $koneksi,
        "INSERT INTO Tabel_user
        (Nama_lengkap, Username, Password, Role, Status_aktif)
        VALUES
        ('$nama_lengkap', '$username', '$password', '$role', $status_aktif)"
    );

    if ($query) {

        header("Location: ../View/Admin.php");
        exit;

    } else {

        die("Gagal menambahkan pengguna: " . mysqli_error($koneksi));

    }
}

?>