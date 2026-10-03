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
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Tambah Area Parkir</title>

    <link rel="stylesheet" href="../Assets/Css/Tambah.css?v=4">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Tambah Area Parkir</h2>

        <form
            action="../Controllers/Tambah_AreaController.php"
            method="POST">

            <label>Nama Area</label>

            <input
                type="text"
                name="nama_area"
                placeholder="Contoh: Area A"
                required>


            <label>Kapasitas</label>

            <input
                type="number"
                name="kapasitas"
                min="1"
                placeholder="Masukkan kapasitas"
                required>


            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a href="Area_Parkir.php" class="btn-batal">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>