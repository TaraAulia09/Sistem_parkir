<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: Login.php?pesan=Silakan Login Dulu!");
    exit;
}

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: Login.php?pesan=Anda Bukan Admin!");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Tambah Kendaraan</title>

    <link rel="stylesheet" href="../Assets/Css/Tambah.css?v=2">

</head>

<body>

<div class="container kendaraan-page">

    <div class="card kendaraan-card">

        <h2>Tambah Kendaraan</h2>

        <form
            action="../Controllers/Tambah_KendaraanController.php"
            method="POST">

            <label>Plat Nomor</label>

            <input
                type="text"
                name="plat_nomor"
                placeholder="Contoh: D 1234 AA"
                required>


            <label>Jenis Kendaraan</label>

            <select name="jenis_kendaraan" required>

                <option value="">-- Pilih Jenis --</option>

                <option value="Motor">Motor</option>

                <option value="Mobil">Mobil</option>

            </select>


            <label>Warna</label>

            <input
                type="text"
                name="warna"
                placeholder="Contoh: Hitam"
                required>


            <label>Pemilik</label>

            <input
                type="text"
                name="pemilik"
                placeholder="Nama pemilik"
                required>


            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a href="Kendaraan.php" class="btn-batal">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>