<?php

class M_Tarif
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Mengambil semua data tarif
    public function getAllTarif()
    {
        return mysqli_query(
            $this->koneksi,
            "SELECT * FROM Tabel_tarif
             ORDER BY Id_tarif ASC"
        );
    }

    // Mengambil satu data tarif berdasarkan ID
    public function getTarifById($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM Tabel_tarif
             WHERE Id_tarif = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($hasil);

        mysqli_stmt_close($stmt);

        return $data;
    }
}
