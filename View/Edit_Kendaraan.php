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

require_once __DIR__ . '/../Config/Koneksi.php';


// Ambil ID kendaraan dari URL
if (!isset($_GET['id'])) {
    header("Location: Kendaraan.php");
    exit;
}

$id_kendaraan = $_GET['id'];


// Ambil data kendaraan
$query = mysqli_prepare(
    $koneksi,
    "SELECT * FROM Tabel_kendaraan WHERE Id_kendaraan = ?"
);

mysqli_stmt_bind_param(
    $query,
    "i",
    $id_kendaraan
);

mysqli_stmt_execute($query);

$hasil = mysqli_stmt_get_result($query);

if (mysqli_num_rows($hasil) == 0) {
    die("Data kendaraan tidak ditemukan.");
}

$data = mysqli_fetch_assoc($hasil);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Kendaraan</title>

    <link rel="stylesheet" href="../Assets/Css/Tambah.css?v=101">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Edit Kendaraan</h2>

        <form
            action="../Controllers/Edit_KendaraanController.php"
            method="POST"
        >

            <input
                type="hidden"
                name="id_kendaraan"
                value="<?php echo $data['Id_kendaraan']; ?>"
            >


            <label>Plat Nomor</label>

            <input
                type="text"
                name="plat_nomor"
                value="<?php echo htmlspecialchars($data['Plat_nomor']); ?>"
                required
            >


            <label>Jenis Kendaraan</label>

            <select name="jenis_kendaraan" required>

                <option value="">-- Pilih Jenis --</option>

                <option
                    value="Motor"
                    <?php
                    echo ($data['Jenis_kendaraan'] == 'Motor')
                        ? 'selected'
                        : '';
                    ?>
                >
                    Motor
                </option>

                <option
                    value="Mobil"
                    <?php
                    echo ($data['Jenis_kendaraan'] == 'Mobil')
                        ? 'selected'
                        : '';
                    ?>
                >
                    Mobil
                </option>

            </select>


            <label>Warna</label>

            <input
                type="text"
                name="warna"
                value="<?php echo htmlspecialchars($data['Warna']); ?>"
                required
            >


            <label>Pemilik</label>

            <input
                type="text"
                name="pemilik"
                value="<?php echo htmlspecialchars($data['Pemilik']); ?>"
                required
            >


            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a
                    href="Kendaraan.php"
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