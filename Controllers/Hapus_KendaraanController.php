<?php

session_start();

require_once __DIR__ . '/../Config/Koneksi.php';

if (
    !isset($_SESSION['role']) ||
    strtolower($_SESSION['role']) !== 'admin'
) {
    header("Location: ../View/Login.php");
    exit;
}

if (
    !isset($_GET['id']) ||
    !ctype_digit($_GET['id'])
) {
    header("Location: ../View/Kendaraan.php");
    exit;
}

$id_kendaraan = (int) $_GET['id'];

$query = mysqli_prepare(
    $koneksi,
    "UPDATE Tabel_kendaraan
     SET Status_aktif = 0
     WHERE Id_kendaraan = ? AND Status_aktif = 1"
);

if (!$query) {
    die("Gagal menyiapkan query: " . htmlspecialchars(mysqli_error($koneksi)));
}

mysqli_stmt_bind_param($query, "i", $id_kendaraan);

if (!mysqli_stmt_execute($query)) {
    $error = mysqli_stmt_error($query);
    mysqli_stmt_close($query);
    die("Gagal menonaktifkan kendaraan: " . htmlspecialchars($error));
}

$jumlah_diubah = mysqli_stmt_affected_rows($query);
mysqli_stmt_close($query);

if ($jumlah_diubah > 0) {
    header("Location: ../View/Kendaraan.php?pesan=berhasil_nonaktif");
    exit;
}

die("Kendaraan tidak ditemukan atau sudah nonaktif.");

?>
