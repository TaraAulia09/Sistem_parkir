<?php

require_once __DIR__ . '/../Config/Koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = strtolower($_POST['role']);

    // Cek username
    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM Tabel_user WHERE Username='$username'"
    );

    if (mysqli_num_rows($cek) > 0) {
        header("Location: ../View/Register.php?pesan=Username sudah digunakan");
        exit;
    }

    // Simpan data
    $query = mysqli_query(
    $koneksi,
    "INSERT INTO Tabel_user
    (Nama_lengkap, Username, Password, Role, Status_aktif)
    VALUES
    ('$nama_lengkap', '$username', '$password', '$role', 1)"
);

    if ($query) {
        header("Location: ../View/Login.php?pesan=Registrasi berhasil");
        exit;
    } else {
        die("Registrasi gagal: " . mysqli_error($koneksi));
    }
}

?>