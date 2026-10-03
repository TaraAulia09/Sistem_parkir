<?php

class OwnerModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }


    // =========================
    // REKAP TRANSAKSI
    // =========================
    public function getRekapTransaksi(
        $tanggal_mulai,
        $tanggal_akhir
    ) {

        $tanggal_mulai = mysqli_real_escape_string(
            $this->koneksi,
            $tanggal_mulai
        );

        $tanggal_akhir = mysqli_real_escape_string(
            $this->koneksi,
            $tanggal_akhir
        );

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
                t.Status

            FROM Tabel_transaksi AS t

            LEFT JOIN Tabel_kendaraan AS k
                ON t.Id_kendaraan = k.Id_kendaraan

            WHERE t.Waktu_masuk >= '$tanggal_mulai 00:00:00'

            AND t.Waktu_masuk < DATE_ADD(
                '$tanggal_akhir',
                INTERVAL 1 DAY
            )

            ORDER BY t.Id_parkir DESC"
        );

        return $query;
    }


    // =========================
    // TOTAL TRANSAKSI
    // =========================
    public function getTotalTransaksi(
        $tanggal_mulai,
        $tanggal_akhir
    ) {

        $tanggal_mulai = mysqli_real_escape_string(
            $this->koneksi,
            $tanggal_mulai
        );

        $tanggal_akhir = mysqli_real_escape_string(
            $this->koneksi,
            $tanggal_akhir
        );

        $query = mysqli_query(
            $this->koneksi,

            "SELECT COUNT(*) AS total

            FROM Tabel_transaksi

            WHERE Waktu_masuk >= '$tanggal_mulai 00:00:00'

            AND Waktu_masuk < DATE_ADD(
                '$tanggal_akhir',
                INTERVAL 1 DAY
            )"
        );

        if (!$query) {
            return 0;
        }

        $data = mysqli_fetch_assoc($query);

        return intval(
            $data['total'] ?? 0
        );
    }


    // =========================
    // TOTAL PENDAPATAN
    // =========================
    public function getTotalPendapatan(
        $tanggal_mulai,
        $tanggal_akhir
    ) {

        $tanggal_mulai = mysqli_real_escape_string(
            $this->koneksi,
            $tanggal_mulai
        );

        $tanggal_akhir = mysqli_real_escape_string(
            $this->koneksi,
            $tanggal_akhir
        );

        $query = mysqli_query(
            $this->koneksi,

            "SELECT
                COALESCE(
                    SUM(Biaya_total),
                    0
                ) AS total

            FROM Tabel_transaksi

            WHERE Waktu_masuk >= '$tanggal_mulai 00:00:00'

            AND Waktu_masuk < DATE_ADD(
                '$tanggal_akhir',
                INTERVAL 1 DAY
            )

            AND LOWER(Status) = 'keluar'"
        );

        if (!$query) {
            return 0;
        }

        $data = mysqli_fetch_assoc($query);

        return $data['total'] ?? 0;
    }
}
?>