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


if (!isset($_GET['id'])) {
    header("Location: ../View/Tarif.php");
    exit;
}


$id_tarif = $_GET['id'];


$query = mysqli_prepare(
    $koneksi,
    "DELETE FROM Tabel_tarif
     WHERE Id_tarif = ?"
);


if (!$query) {
    die("Prepare gagal: " . mysqli_error($koneksi));
}


mysqli_stmt_bind_param(
    $query,
    "i",
    $id_tarif
);


if (!mysqli_stmt_execute($query)) {

    die(
        "Gagal menghapus tarif: " .
        mysqli_stmt_error($query)
    );

}


header("Location: ../View/Tarif.php");
exit;

?>