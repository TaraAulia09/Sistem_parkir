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
    header("Location: ../View/Area_Parkir.php");
    exit;
}

$id_area = (int) $_GET['id'];


// Cek apakah area sudah digunakan transaksi
$cek = mysqli_query(
    $koneksi,
    "SELECT Id_parkir
     FROM Tabel_transaksi
     WHERE Id_area = '$id_area'
     LIMIT 1"
);

if (!$cek) {
    die(
        "Gagal mengecek transaksi: "
        . mysqli_error($koneksi)
    );
}


// Jika sudah digunakan
if (mysqli_num_rows($cek) > 0) {

    echo "<script>
        alert('Area tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        window.location.href='../View/Area_Parkir.php';
    </script>";

    exit;
}


// Jika belum digunakan, hapus
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM Tabel_area_parkir
     WHERE Id_area_parkir = '$id_area'"
);


if ($hapus) {

    header("Location: ../View/Area_Parkir.php");
    exit;

} else {

    die(
        "Gagal menghapus area: "
        . mysqli_error($koneksi)
    );

}

?>