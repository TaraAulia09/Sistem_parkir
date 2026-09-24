<?php

session_start();

require_once __DIR__ . '/../Config/Koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>

       <link rel="stylesheet" href="../Assets/Css/Tambah.css">
       
</head>

<body>

<div class="container">

    <div class="card">

        <h2>Tambah Pengguna</h2>

        <form action="../Controllers/Tambah_PenggunaController.php" method="POST">

            <label>Nama Lengkap</label>

            <input
                type="text"
                name="nama_lengkap"
                placeholder="Masukkan nama lengkap"
                required
            >

            <br><br>

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan username"
                required
            >

            <br><br>

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <br><br>

            <label>Role</label>

            <select name="role" required>

                <option value="">-- Pilih Role --</option>

                <option value="Admin">
                    Admin
                </option>

                <option value="Petugas">
                    Petugas
                </option>

                <option value="Owner">
                    Owner
                </option>

            </select>

            <br><br>

            <button type="submit">
                Simpan
            </button>

            <a href="Admin.php">
                Batal
            </a>

        </form>

    </div>

</div>

</body>
</html>