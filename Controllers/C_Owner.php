<?php

require_once "../Models/M_Owner.php";

class C_Owner
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_Owner($koneksi);
    }

    // CEK AKSES OWNER
    public function cekAkses()
    {
        if (!isset($_SESSION['role'])) {
            header("Location: Login.php?pesan=Silakan Login Dulu!");
            exit;
        }

        if (strtolower($_SESSION['role']) != 'owner') {
            header("Location: Login.php?pesan=Anda Bukan Owner!");
            exit;
        }
    }

    // AMBIL REKAP TRANSAKSI
    public function getRekap(
        $tanggal_mulai,
        $tanggal_akhir,
        $nama_area = ''
    ) {
        return $this->model->getRekapTransaksi(
            $tanggal_mulai,
            $tanggal_akhir,
            $nama_area
        );
    }

    // TOTAL TRANSAKSI
    public function getTotalTransaksi(
        $tanggal_mulai,
        $tanggal_akhir
    ) {
        return $this->model->getTotalTransaksi(
            $tanggal_mulai,
            $tanggal_akhir
        );
    }

    // TOTAL PENDAPATAN
    public function getTotalPendapatan(
        $tanggal_mulai,
        $tanggal_akhir
    ) {
        return $this->model->getTotalPendapatan(
            $tanggal_mulai,
            $tanggal_akhir
        );
    }
}

?>
