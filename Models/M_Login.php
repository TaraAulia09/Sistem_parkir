<?php

function loginUser($koneksi, $username, $password)
{
    $query = mysqli_prepare(
        $koneksi,
        "SELECT * FROM Tabel_user
         WHERE Username = ? AND Password = ?"
    );

    if (!$query) {
        die("Query login gagal: " . mysqli_error($koneksi));
    }

    mysqli_stmt_bind_param(
        $query,
        "ss",
        $username,
        $password
    );

    mysqli_stmt_execute($query);

    $hasil = mysqli_stmt_get_result($query);

    if (!$hasil) {
        die("Gagal mengambil data login.");
    }

    $data = mysqli_fetch_assoc($hasil);

    mysqli_stmt_close($query);

    return $data ?: false;
}

?>
