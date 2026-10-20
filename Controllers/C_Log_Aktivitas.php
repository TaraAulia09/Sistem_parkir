<?php

require_once __DIR__ . '/../Models/M_Log_Aktivitas.php';

class C_Log_Aktivitas
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_Log_Aktivitas($koneksi);
    }

    public function cekAkses()
    {
        if (
            !isset($_SESSION['role']) ||
            strtolower($_SESSION['role']) !== 'admin'
        ) {
            header(
                "Location: Login.php?pesan="
                . urlencode("Silakan login sebagai Admin!")
            );
            exit;
        }
    }

    public function index()
    {
        return [
            'logs' => $this->model->getLogAktivitas(),
            'total_log' => $this->model->getTotalLog()
        ];
    }
}