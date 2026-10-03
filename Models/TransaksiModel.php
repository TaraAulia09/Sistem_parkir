<?php

class TransaksiModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }


    /* =========================
       DATA KENDARAAN
    ========================= */

    public function getKendaraan()
    {
        return mysqli_query(
            $this->koneksi,
            "SELECT
                Id_kendaraan,
                Plat_nomor,
                Jenis_kendaraan,
                Warna,
                Pemilik
             FROM Tabel_kendaraan
             ORDER BY Id_kendaraan DESC"
        );
    }


    public function getKendaraanById($id_kendaraan)
    {
        $id_kendaraan = intval($id_kendaraan);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT
                Id_kendaraan,
                Plat_nomor,
                Jenis_kendaraan,
                Warna,
                Pemilik
             FROM Tabel_kendaraan
             WHERE Id_kendaraan = $id_kendaraan
             LIMIT 1"
        );

        return mysqli_fetch_assoc($query);
    }


    /* =========================
       DATA AREA PARKIR
    ========================= */

    public function getArea()
    {
        return mysqli_query(
            $this->koneksi,
            "SELECT
                Id_area_parkir,
                Nama_area,
                Kapasitas,
                Terisi
             FROM Tabel_area_parkir
             ORDER BY Id_area_parkir ASC"
        );
    }


    public function getAreaById($id_area)
    {
        $id_area = intval($id_area);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT
                Id_area_parkir,
                Nama_area,
                Kapasitas,
                Terisi
             FROM Tabel_area_parkir
             WHERE Id_area_parkir = $id_area
             LIMIT 1"
        );

        return mysqli_fetch_assoc($query);
    }


    /* =========================
       DATA TARIF
    ========================= */

    public function getTarifByJenis($jenis_kendaraan)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT
                Id_tarif,
                Jenis_kendaraan,
                Tarif_per_jam
             FROM Tabel_tarif
             WHERE Jenis_kendaraan = ?
             LIMIT 1"
        );

        if (!$stmt) {
            return null;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $jenis_kendaraan
        );

        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($hasil);
    }


    public function getTarifById($id_tarif)
    {
        $id_tarif = intval($id_tarif);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT
                Id_tarif,
                Jenis_kendaraan,
                Tarif_per_jam
             FROM Tabel_tarif
             WHERE Id_tarif = $id_tarif
             LIMIT 1"
        );

        return mysqli_fetch_assoc($query);
    }


    /* =========================
       CEK KENDARAAN MASIH PARKIR
    ========================= */

    public function cekKendaraanMasuk($id_kendaraan)
    {
        $id_kendaraan = intval($id_kendaraan);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT Id_parkir
             FROM Tabel_transaksi
             WHERE Id_kendaraan = $id_kendaraan
             AND LOWER(Status) = 'masuk'
             LIMIT 1"
        );

        return mysqli_num_rows($query) > 0;
    }


    /* =========================
       SIMPAN TRANSAKSI MASUK
    ========================= */

    public function simpanMasuk(
        $id_kendaraan,
        $id_tarif,
        $id_user,
        $id_area
    ) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO Tabel_transaksi
            (
                Id_kendaraan,
                Waktu_masuk,
                Waktu_keluar,
                Id_tarif,
                Durasi_jam,
                Biaya_total,
                Status,
                Id_user,
                Id_area
            )
            VALUES
            (
                ?,
                NOW(),
                NULL,
                ?,
                0,
                0,
                'Masuk',
                ?,
                ?
            )"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "iiii",
            $id_kendaraan,
            $id_tarif,
            $id_user,
            $id_area
        );

        return mysqli_stmt_execute($stmt);
    }


    /* =========================
       TAMBAH ISI AREA
    ========================= */

    public function tambahTerisi($id_area)
    {
        $id_area = intval($id_area);

        return mysqli_query(
            $this->koneksi,
            "UPDATE Tabel_area_parkir
             SET Terisi = Terisi + 1
             WHERE Id_area_parkir = $id_area"
        );
    }


    /* =========================
       AMBIL TRANSAKSI BERDASARKAN ID
    ========================= */

    public function getTransaksiById($id_parkir)
    {
        $id_parkir = intval($id_parkir);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT
                Id_parkir,
                Id_kendaraan,
                Id_area,
                Waktu_masuk,
                Id_tarif,
                Durasi_jam,
                Biaya_total,
                Status
             FROM Tabel_transaksi
             WHERE Id_parkir = $id_parkir
             LIMIT 1"
        );

        return mysqli_fetch_assoc($query);
    }


    /* =========================
       HITUNG DURASI
    ========================= */

    public function hitungDurasi($id_parkir)
    {
        $id_parkir = intval($id_parkir);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT
                GREATEST(
                    1,
                    CEIL(
                        TIMESTAMPDIFF(
                            MINUTE,
                            Waktu_masuk,
                            NOW()
                        ) / 60
                    )
                ) AS durasi
             FROM Tabel_transaksi
             WHERE Id_parkir = $id_parkir
             LIMIT 1"
        );

        if (!$query) {
            return 1;
        }

        $data = mysqli_fetch_assoc($query);

        return intval($data['durasi'] ?? 1);
    }


    /* =========================
       PROSES KENDARAAN KELUAR
    ========================= */

    public function prosesKeluar(
        $id_parkir,
        $durasi,
        $biaya_total
    ) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE Tabel_transaksi
             SET
                Waktu_keluar = NOW(),
                Durasi_jam = ?,
                Biaya_total = ?,
                Status = 'Keluar'
             WHERE Id_parkir = ?"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "idi",
            $durasi,
            $biaya_total,
            $id_parkir
        );

        return mysqli_stmt_execute($stmt);
    }


    /* =========================
       KURANGI ISI AREA
    ========================= */

    public function kurangiTerisi($id_area)
    {
        $id_area = intval($id_area);

        return mysqli_query(
            $this->koneksi,
            "UPDATE Tabel_area_parkir
             SET Terisi = GREATEST(Terisi - 1, 0)
             WHERE Id_area_parkir = $id_area"
        );
    }


    /* =========================
       AMBIL SEMUA TRANSAKSI
    ========================= */

    public function getTransaksi()
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
             ORDER BY t.Id_parkir DESC"
        );
    }
}