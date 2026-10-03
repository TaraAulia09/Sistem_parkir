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

require_once __DIR__ . '/../Config/Koneksi.php';


// Ambil ID tarif
if (!isset($_GET['id'])) {
    header("Location: Tarif.php");
    exit;
}

$id_tarif = $_GET['id'];


// Ambil data tarif
$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM Tabel_tarif
     WHERE Id_tarif = '$id_tarif'"
);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data tarif tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Tarif</title>

    <link rel="stylesheet" href="../Assets/Css/Tambah.css?v=101">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Edit Tarif Parkir</h2>

        <form
            action="../Controllers/Edit_TarifController.php"
            method="POST"
        >

            <input
                type="hidden"
                name="id_tarif"
                value="<?php echo $data['Id_tarif']; ?>"
            >


            <label>Jenis Kendaraan</label>

            <select name="jenis_kendaraan" required>

                <option value="">-- Pilih Jenis --</option>

                <option
                    value="Motor"
                    <?php
                    if ($data['Jenis_kendaraan'] == 'Motor') {
                        echo 'selected';
                    }
                    ?>
                >
                    Motor
                </option>

                <option
                    value="Mobil"
                    <?php
                    if ($data['Jenis_kendaraan'] == 'Mobil') {
                        echo 'selected';
                    }
                    ?>
                >
                    Mobil
                </option>

            </select>


            <label>Tarif Per Jam</label>

            <input
                type="number"
                name="tarif_per_jam"
                value="<?php echo $data['Tarif_per_jam']; ?>"
                min="0"
                required
            >


            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a
                    href="Tarif.php"
                    class="btn-batal"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>