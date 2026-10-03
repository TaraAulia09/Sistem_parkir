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
    header("Location: ../View/Tambah_Area.php");
    exit;
}


// Ambil data dari form
$nama_area = $_POST['nama_area'];
$kapasitas = $_POST['kapasitas'];


// Terisi awal
$terisi = 0;


// Simpan data area
$simpan = mysqli_query(
    $koneksi,
    "INSERT INTO Tabel_area_parkir
    (Nama_area, Kapasitas, Terisi)
    VALUES
    ('$nama_area', '$kapasitas', '$terisi')"
);


if ($simpan) {

    header("Location: ../View/Area_Parkir.php");
    exit;

} else {

    die(
        "Gagal menambahkan area: "
        . mysqli_error($koneksi)
    );

}

?>