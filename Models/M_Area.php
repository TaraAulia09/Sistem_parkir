<?php

class M_Area
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Mengambil semua data area
    public function getAllArea()
    {
        return mysqli_query(
            $this->koneksi,
            "SELECT * FROM Tabel_area_parkir
             ORDER BY Id_area_parkir ASC"
        );
    }

    // Mengambil satu data area berdasarkan ID
    public function getAreaById($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM Tabel_area_parkir
             WHERE Id_area_parkir = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($hasil);

        mysqli_stmt_close($stmt);

        return $data;
    }

    // Menambah area parkir
    public function tambahArea($nama_area, $kapasitas)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO Tabel_area_parkir
             (Nama_area, Kapasitas, Terisi)
             VALUES (?, ?, 0)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $nama_area,
            $kapasitas
        );

        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $berhasil;
    }

    // Mengedit area parkir
    public function editArea($id, $nama_area, $kapasitas)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE Tabel_area_parkir
             SET Nama_area = ?, Kapasitas = ?
             WHERE Id_area_parkir = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sii",
            $nama_area,
            $kapasitas,
            $id
        );

        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $berhasil;
    }

    // Mengecek apakah area digunakan dalam transaksi
    public function cekTransaksiArea($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT Id_parkir
             FROM Tabel_transaksi
             WHERE Id_area = ?
             LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $ada = mysqli_num_rows($hasil) > 0;

        mysqli_stmt_close($stmt);

        return $ada;
    }

    // Menghapus area parkir
    public function hapusArea($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM Tabel_area_parkir
             WHERE Id_area_parkir = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);

        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $berhasil;
    }
}