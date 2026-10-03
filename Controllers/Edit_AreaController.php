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
    header("Location: ../View/Area_Parkir.php");
    exit;
}


// Ambil data dari form
$id_area = $_POST['id_area_parkir'];
$nama_area = $_POST['nama_area'];
$kapasitas = $_POST['kapasitas'];


// Update data area
$ubah = mysqli_query(
    $koneksi,
    "UPDATE Tabel_area_parkir
     SET
        Nama_area = '$nama_area',
        Kapasitas = '$kapasitas'
     WHERE Id_area_parkir = '$id_area'"
);


if ($ubah) {

    header("Location: ../View/Area_Parkir.php");
    exit;

} else {

    die(
        "Gagal mengubah area: "
        . mysqli_error($koneksi)
    );

}

?>