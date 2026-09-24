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


// Cek ID

if (!isset($_GET['id'])) {
    header("Location: ../View/Kendaraan.php");
    exit;
}

$id_kendaraan = $_GET['id'];


// Hapus kendaraan

$query = mysqli_prepare(
    $koneksi,
    "DELETE FROM Tabel_kendaraan
     WHERE Id_kendaraan = ?"
);

mysqli_stmt_bind_param(
    $query,
    "i",
    $id_kendaraan
);


if (mysqli_stmt_execute($query)) {

    header("Location: ../View/Kendaraan.php");
    exit;

} else {

    die(
        "Gagal menghapus kendaraan: " .
        mysqli_error($koneksi)
    );

}

?>