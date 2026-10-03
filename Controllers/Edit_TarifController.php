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
    header("Location: ../View/Tarif.php");
    exit;
}


$id_tarif = $_POST['id_tarif'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$tarif_per_jam = $_POST['tarif_per_jam'];


$query = mysqli_prepare(
    $koneksi,
    "UPDATE Tabel_tarif
     SET Jenis_kendaraan = ?,
         Tarif_per_jam = ?
     WHERE Id_tarif = ?"
);


if (!$query) {
    die("Prepare gagal: " . mysqli_error($koneksi));
}


mysqli_stmt_bind_param(
    $query,
    "sii",
    $jenis_kendaraan,
    $tarif_per_jam,
    $id_tarif
);


if (!mysqli_stmt_execute($query)) {

    die(
        "Gagal mengubah tarif: " .
        mysqli_stmt_error($query)
    );

}


header("Location: ../View/Tarif.php");
exit;

?>