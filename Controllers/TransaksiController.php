<?php

require_once "../Models/TransaksiModel.php";

class TransaksiController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new TransaksiModel($koneksi);
    }

    public function simpanMasuk($id_user)
    {
        $id_kendaraan = intval($_POST['id_kendaraan'] ?? 0);
        $id_area = intval($_POST['id_area'] ?? 0);

        if ($id_kendaraan <= 0 || $id_area <= 0) {
            $this->redirect("Data belum lengkap");
        }

        $kendaraan = $this->model->getKendaraanById($id_kendaraan);

        if (!$kendaraan) {
            $this->redirect("Kendaraan tidak ditemukan");
        }

        $tarif = $this->model->getTarifByJenis(
            $kendaraan['Jenis_kendaraan']
        );

        if (!$tarif) {
            $this->redirect("Tarif kendaraan belum tersedia");
        }

        if ($this->model->cekKendaraanMasuk($id_kendaraan)) {
            $this->redirect(
                "Kendaraan masih berada di area parkir"
            );
        }

        $area = $this->model->getAreaById($id_area);

        if (!$area) {
            $this->redirect(
                "Area parkir tidak ditemukan"
            );
        }

        if ($area['Terisi'] >= $area['Kapasitas']) {
            $this->redirect("Area parkir penuh");
        }

        $berhasil = $this->model->simpanMasuk(
            $id_kendaraan,
            $tarif['Id_tarif'],
            $id_user,
            $id_area
        );

        if ($berhasil) {
            $this->model->tambahTerisi($id_area);

            $this->redirect(
                "Transaksi berhasil disimpan"
            );
        }

        $this->redirect("Transaksi gagal disimpan");
    }


    public function prosesKeluar()
    {
        $id_parkir = intval($_GET['keluar'] ?? 0);

        if ($id_parkir <= 0) {
            $this->redirect(
                "ID transaksi tidak valid"
            );
        }

        $transaksi =
            $this->model->getTransaksiById($id_parkir);

        if (!$transaksi) {
            $this->redirect(
                "Transaksi tidak ditemukan"
            );
        }

        if (
            strtolower($transaksi['Status']) == 'keluar'
        ) {
            $this->redirect(
                "Kendaraan sudah keluar"
            );
        }

        $tarif =
            $this->model->getTarifById(
                $transaksi['Id_tarif']
            );

        if (!$tarif) {
            $this->redirect(
                "Tarif tidak ditemukan"
            );
        }

        $durasi =
            $this->model->hitungDurasi($id_parkir);

        $biaya_total =
            $durasi * floatval($tarif['Tarif_per_jam']);

        $berhasil =
            $this->model->prosesKeluar(
                $id_parkir,
                $durasi,
                $biaya_total
            );

        if ($berhasil) {

            $this->model->kurangiTerisi(
                $transaksi['Id_area']
            );

            $this->redirect(
                "Kendaraan berhasil keluar"
            );
        }

        $this->redirect(
            "Gagal memproses kendaraan keluar"
        );
    }


    public function getKendaraan()
    {
        return $this->model->getKendaraan();
    }


    public function getArea()
    {
        return $this->model->getArea();
    }


    public function getTransaksi()
    {
        return $this->model->getTransaksi();
    }


    private function redirect($pesan)
{
    header(
        "Location: Transaksi.php?pesan="
        . urlencode($pesan)
    );

    exit;
}
}