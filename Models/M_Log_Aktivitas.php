<?php

class M_Log_Aktivitas
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function getLogAktivitas()
    {
        $sql = "SELECT
                    l.Id_log,
                    l.Id_user,
                    u.Nama_lengkap,
                    u.Username,
                    l.Aktifitas,
                    l.Waktu_aktivitas
                FROM Tabel_log_aktivitas AS l
                LEFT JOIN Tabel_user AS u
                    ON l.Id_user = u.Id_user
                ORDER BY l.Id_log ASC";

        $query = mysqli_query($this->koneksi, $sql);

        if (!$query) {
            die("Gagal mengambil data log aktivitas: "
                . mysqli_error($this->koneksi));
        }

        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getTotalLog()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM Tabel_log_aktivitas";

        $query = mysqli_query($this->koneksi, $sql);

        if (!$query) {
            die("Gagal menghitung log aktivitas: "
                . mysqli_error($this->koneksi));
        }

        $data = mysqli_fetch_assoc($query);

        return (int) $data['total'];
    }
}