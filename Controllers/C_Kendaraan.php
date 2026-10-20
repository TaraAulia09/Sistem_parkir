<?php
require_once __DIR__ . '/../Models/M_Kendaraan.php';

class C_Kendaraan
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_Kendaraan($koneksi);
    }

    public function getAllKendaraan()
    {
        return $this->model->getAll();
    }
}
?>
