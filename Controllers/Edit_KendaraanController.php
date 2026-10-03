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


// Pastikan data dikirim dari form
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Kendaraan.php");
    exit;
}


// Ambil data dari form
$id_kendaraan = $_POST['id_kendaraan'];
$plat_nomor = $_POST['plat_nomor'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$warna = $_POST['warna'];
$pemilik = $_POST['pemilik'];


// Update data kendaraan
$ubah = mysqli_query(
    $koneksi,
    "UPDATE Tabel_kendaraan
     SET
        Plat_nomor = '$plat_nomor',
        Jenis_kendaraan = '$jenis_kendaraan',
        Warna = '$warna',
        Pemilik = '$pemilik'
     WHERE Id_kendaraan = '$id_kendaraan'"
);


if ($ubah) {

    header("Location: ../View/Kendaraan.php");
    exit;

} else {

    die(
        "Gagal mengubah kendaraan: "
        . mysqli_error($koneksi)
    );

}

?>