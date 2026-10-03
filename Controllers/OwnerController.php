<?php

require_once "../Models/OwnerModel.php";

class OwnerController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new OwnerModel($koneksi);
    }


    // =========================
    // CEK LOGIN OWNER
    // =========================
    public function cekAkses()
    {
        if (!isset($_SESSION['role'])) {
            header(
                "Location: Login.php?pesan=Silakan Login Dulu!"
            );
            exit;
        }

        if (
            strtolower($_SESSION['role']) != 'owner'
        ) {
            header(
                "Location: Login.php?pesan=Anda Bukan Owner!"
            );
            exit;
        }
    }


    // =========================
    // AMBIL REKAP
    // =========================
    public function getRekap(
        $tanggal_mulai,
        $tanggal_akhir
    ) {
        return $this->model->getRekapTransaksi(
            $tanggal_mulai,
            $tanggal_akhir
        );
    }


    // =========================
    // TOTAL TRANSAKSI
    // =========================
    public function getTotalTransaksi(
        $tanggal_mulai,
        $tanggal_akhir
    ) {
        return $this->model->getTotalTransaksi(
            $tanggal_mulai,
            $tanggal_akhir
        );
    }


    // =========================
    // TOTAL PENDAPATAN
    // =========================
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