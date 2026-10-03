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


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../View/Tambah_Tarif.php");
    exit;
}


$jenis_kendaraan = $_POST['jenis_kendaraan'];
$tarif_per_jam = $_POST['tarif_per_jam'];


$query = mysqli_prepare(
    $koneksi,
    "INSERT INTO Tabel_tarif
    (Jenis_kendaraan, Tarif_per_jam)
    VALUES (?, ?)"
);


if (!$query) {
    die("Prepare gagal: " . mysqli_error($koneksi));
}


mysqli_stmt_bind_param(
    $query,
    "si",
    $jenis_kendaraan,
    $tarif_per_jam
);


if (!mysqli_stmt_execute($query)) {

    die(
        "Gagal menambahkan tarif: " .
        mysqli_stmt_error($query)
    );

}


header("Location: ../View/Tarif.php");
exit;

?>