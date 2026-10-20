<?php

require_once "../Models/M_CetakStruk.php";

class C_CetakStruk
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_CetakStruk($koneksi);
    }


    // =========================
    // AMBIL DAFTAR TRANSAKSI KELUAR
    // =========================
    public function getTransaksiKeluar()
    {
        return $this->model->getTransaksiKeluar();
    }


    // =========================
    // AMBIL DETAIL STRUK
    // =========================
    public function getStrukById($id_parkir)
    {
        return $this->model->getStrukById($id_parkir);
    }


    // =========================
    // CEK ID STRUK
    // =========================
    public function prosesStruk()
    {
        if (!isset($_GET['id'])) {
            return null;
        }

        $id_parkir = intval($_GET['id']);

        if ($id_parkir <= 0) {
            return null;
        }

        return $this->getStrukById($id_parkir);
    }
}
?>