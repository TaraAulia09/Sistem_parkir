<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: Login.php");
    exit;
}

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: Login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Tambah Tarif - Parkir</title>

   <link rel="stylesheet"href="../Assets/Css/Tambah.css?v=3">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Tambah Tarif</h2>

        <form
            action="../Controllers/Tambah_TarifController.php"
            method="POST">

            <label>
                Jenis Kendaraan
            </label>

            <select name="jenis_kendaraan" required>

                <option value="">
                    -- Pilih Jenis --
                </option>

                <option value="Motor">
                    Motor
                </option>

                <option value="Mobil">
                    Mobil
                </option>

            </select>


            <label>
                Tarif Per Jam
            </label>

            <input
                type="number"
                name="tarif_per_jam"
                placeholder="Contoh: 5000"
                min="0"
                required
            >


            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a
                    href="Tarif.php"
                    class="btn-batal">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>