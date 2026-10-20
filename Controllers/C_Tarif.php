<?php

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/M_Tarif.php';

class C_Tarif
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_Tarif($koneksi);
    }

    // Mengambil semua data tarif
    public function getAllTarif()
    {
        return $this->model->getAllTarif();
    }

    // Mengambil satu data tarif berdasarkan ID
    public function getTarifById($id)
    {
        return $this->model->getTarifById($id);
    }
}
