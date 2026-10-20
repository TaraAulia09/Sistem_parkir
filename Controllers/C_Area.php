<?php

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Models/M_Area.php';

class C_Area
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_Area($koneksi);
    }

    // Mengambil daftar area
    public function getAllArea()
    {
        return $this->model->getAllArea();
    }
}