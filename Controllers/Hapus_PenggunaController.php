<?php

require_once __DIR__ . '/../Config/Koneksi.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = mysqli_query(
        $koneksi,
        "DELETE FROM Tabel_user WHERE Id_user='$id'"
    );

    if ($query) {
        header("Location: ../View/Admin.php?pesan=Data berhasil dihapus");
        exit;
    } else {
        die("Gagal menghapus pengguna: " . mysqli_error($koneksi));
    }

} else {
    die("ID pengguna tidak ditemukan.");
}

?>