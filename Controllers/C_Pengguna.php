<?php

require_once __DIR__ . '/../Models/M_Pengguna.php';

class C_Pengguna
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new M_Pengguna($koneksi);
    }

    // READ: Mengambil semua data pengguna
    public function getAllPengguna()
    {
        return $this->model->getAllPengguna();
    }

    // READ: Menghitung total pengguna
    public function getTotalPengguna()
    {
        return $this->model->getTotalPengguna();
    }

    // READ: Mengambil satu pengguna berdasarkan ID
    public function getPenggunaById($id)
    {
        return $this->model->getPenggunaById($id);
    }

    // UPDATE: Mengubah data pengguna
    public function editPengguna(
        $id,
        $nama_lengkap,
        $username,
        $password,
        $role
    ) {
        return $this->model->editPengguna(
            $id,
            $nama_lengkap,
            $username,
            $password,
            $role
        );
    }
}
