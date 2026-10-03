<?php

class CetakStrukModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // =========================
    // AMBIL SEMUA TRANSAKSI KELUAR
    // =========================
    public function getTransaksiKeluar()
    {
        return mysqli_query(
            $this->koneksi,
            "SELECT
                t.Id_parkir,
                k.Plat_nomor,
                k.Jenis_kendaraan,
                k.Warna,
                k.Pemilik,
                t.Waktu_masuk,
                t.Waktu_keluar,
                t.Durasi_jam,
                t.Biaya_total,
                t.Status
            FROM Tabel_transaksi AS t

            LEFT JOIN Tabel_kendaraan AS k
                ON t.Id_kendaraan = k.Id_kendaraan

            WHERE t.Status = 'Keluar'

            ORDER BY t.Id_parkir DESC"
        );
    }


    // =========================
    // AMBIL DETAIL STRUK
    // =========================
    public function getStrukById($id_parkir)
    {
        $id_parkir = intval($id_parkir);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT
                t.Id_parkir,
                k.Plat_nomor,
                k.Jenis_kendaraan,
                k.Warna,
                k.Pemilik,
                t.Waktu_masuk,
                t.Waktu_keluar,
                t.Durasi_jam,
                t.Biaya_total,
                t.Status,
                a.Nama_area,
                tr.Tarif_per_jam

            FROM Tabel_transaksi AS t

            LEFT JOIN Tabel_kendaraan AS k
                ON t.Id_kendaraan = k.Id_kendaraan

            LEFT JOIN Tabel_area_parkir AS a
                ON t.Id_area = a.Id_area_parkir

            LEFT JOIN Tabel_tarif AS tr
                ON t.Id_tarif = tr.Id_tarif

            WHERE t.Id_parkir = $id_parkir

            LIMIT 1"
        );

        if (!$query) {
            return null;
        }

        return mysqli_fetch_assoc($query);
    }
}
?>