<?php

class KendaraanModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }


    // =========================
    // AMBIL SEMUA KENDARAAN
    // =========================

    public function getAll()
    {
        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM Tabel_kendaraan
             ORDER BY Id_kendaraan ASC"
        );

        return $query;
    }


    // =========================
    // AMBIL 1 KENDARAAN
    // =========================

    public function getById($id)
    {
        $query = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM Tabel_kendaraan
             WHERE Id_kendaraan = ?"
        );

        mysqli_stmt_bind_param(
            $query,
            "i",
            $id
        );

        mysqli_stmt_execute($query);

        $hasil = mysqli_stmt_get_result($query);

        return mysqli_fetch_assoc($hasil);
    }


    // =========================
    // TAMBAH KENDARAAN
    // =========================

    public function tambah(
    $id_user,
    $plat_nomor,
    $jenis_kendaraan,
    $warna,
    $pemilik
) {
    $query = mysqli_prepare(
        $this->koneksi,
        "INSERT INTO Tabel_kendaraan
        (Id_user, Plat_nomor, Jenis_kendaraan, Warna, Pemilik)
        VALUES (?, ?, ?, ?, ?)"
    );

    if (!$query) {
        die("Prepare gagal: " . mysqli_error($this->koneksi));
    }

    mysqli_stmt_bind_param(
        $query,
        "issss",
        $id_user,
        $plat_nomor,
        $jenis_kendaraan,
        $warna,
        $pemilik
    );

    if (!mysqli_stmt_execute($query)) {
        die(
            "Gagal menambahkan kendaraan: " .
            mysqli_stmt_error($query)
        );
    }

    return true;
    }


    // =========================
    // EDIT KENDARAAN
    // =========================

    public function edit(
        $id,
        $plat_nomor,
        $jenis_kendaraan,
        $warna,
        $pemilik
    ) {
        $query = mysqli_prepare(
            $this->koneksi,
            "UPDATE Tabel_kendaraan
             SET
                Plat_nomor = ?,
                Jenis_kendaraan = ?,
                Warna = ?,
                Pemilik = ?
             WHERE Id_kendaraan = ?"
        );

        mysqli_stmt_bind_param(
            $query,
            "ssssi",
            $plat_nomor,
            $jenis_kendaraan,
            $warna,
            $pemilik,
            $id
        );

        return mysqli_stmt_execute($query);
    }


    // =========================
    // HAPUS KENDARAAN
    // =========================

    public function hapus($id)
    {
        $query = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM Tabel_kendaraan
             WHERE Id_kendaraan = ?"
        );

        mysqli_stmt_bind_param(
            $query,
            "i",
            $id
        );

        return mysqli_stmt_execute($query);
    }
}

?>