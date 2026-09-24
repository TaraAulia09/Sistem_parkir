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


// Ambil data dari form

$id_kendaraan = $_POST['id_kendaraan'];
$plat_nomor = $_POST['plat_nomor'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$warna = $_POST['warna'];
$pemilik = $_POST['pemilik'];


// Update data

$query = mysqli_prepare(
    $koneksi,
    "UPDATE Tabel_kendaraan
     SET
        Plat_nomor = ?,
        Jenis_kendaraan = ?,
        Warna = ?,
        Pemilik = ?
     WHERE Id_kendaraan = ?"
);


mysqli_stmt_bind_param(
    $query,
    "ssssi",
    $plat_nomor,
    $jenis_kendaraan,
    $warna,
    $pemilik,
    $id_kendaraan
);


if (mysqli_stmt_execute($query)) {

    header("Location: ../View/Kendaraan.php");
    exit;

} else {

    die(
        "Gagal mengubah data kendaraan: " .
        mysqli_error($koneksi)
    );

}

?>