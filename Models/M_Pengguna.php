<?php

class M_Pengguna
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Mengambil semua data pengguna
    public function getAllPengguna()
    {
        return mysqli_query(
            $this->koneksi,
            "SELECT Id_user, Nama_lengkap, Username, Role
             FROM Tabel_user
             ORDER BY Id_user ASC"
        );
    }

    // Menghitung total pengguna
    public function getTotalPengguna()
    {
        $hasil = mysqli_query(
            $this->koneksi,
            "SELECT COUNT(*) AS total FROM Tabel_user"
        );

        if (!$hasil) {
            return false;
        }

        $data = mysqli_fetch_assoc($hasil);

        return (int) $data['total'];
    }

    // Mengambil satu pengguna berdasarkan ID
    public function getPenggunaById($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT Id_user, Nama_lengkap, Username, Password, Role
             FROM Tabel_user
             WHERE Id_user = ?"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $data = $hasil ? mysqli_fetch_assoc($hasil) : null;

        mysqli_stmt_close($stmt);

        return $data ?: null;
    }

    // Menambahkan pengguna
    public function tambahPengguna(
        $nama_lengkap,
        $username,
        $password,
        $role
    ) {
        $status_aktif = 1;

        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO Tabel_user
            (Nama_lengkap, Username, Password, Role, Status_aktif)
            VALUES (?, ?, ?, ?, ?)"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $nama_lengkap,
            $username,
            $password,
            $role,
            $status_aktif
        );

        $berhasil = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $berhasil;
    }

    // Mengubah data pengguna
    public function editPengguna(
        $id,
        $nama_lengkap,
        $username,
        $password,
        $role
    ) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE Tabel_user
             SET Nama_lengkap = ?,
                 Username = ?,
                 Password = ?,
                 Role = ?
             WHERE Id_user = ?"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $nama_lengkap,
            $username,
            $password,
            $role,
            $id
        );

        $berhasil = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $berhasil;
    }

    // Menghapus pengguna
    public function hapusPengguna($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM Tabel_user WHERE Id_user = ?"
        );

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "i", $id);

        $berhasil = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $berhasil;
    }
}
?>