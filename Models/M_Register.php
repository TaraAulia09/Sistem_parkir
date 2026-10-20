<?php

function cekUsername($koneksi, $username)
{
    $query = mysqli_prepare(
        $koneksi,
        "SELECT Id_user FROM Tabel_user WHERE Username = ?"
    );

    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);

    $hasil = mysqli_stmt_get_result($query);
    $ada = mysqli_num_rows($hasil) > 0;

    mysqli_stmt_close($query);

    return $ada;
}

function simpanPengguna(
    $koneksi,
    $nama_lengkap,
    $username,
    $password,
    $role
) {
    $query = mysqli_prepare(
        $koneksi,
        "INSERT INTO Tabel_user
        (Nama_lengkap, Username, Password, Role, Status_aktif)
        VALUES (?, ?, ?, ?, 1)"
    );

    mysqli_stmt_bind_param(
        $query,
        "ssss",
        $nama_lengkap,
        $username,
        $password,
        $role
    );

    $berhasil = mysqli_stmt_execute($query);

    mysqli_stmt_close($query);

    return $berhasil;
}

?>
