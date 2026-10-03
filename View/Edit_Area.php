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


/* AMBIL ID AREA */

if (!isset($_GET['id'])) {
    header("Location: Area_Parkir.php");
    exit;
}

$id_area = $_GET['id'];


/* AMBIL DATA AREA */

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM Tabel_area_parkir
     WHERE Id_area_parkir = '$id_area'"
);

if (!$query) {
    die("Gagal mengambil data area: " . mysqli_error($koneksi));
}


/* CEK DATA */

if (mysqli_num_rows($query) == 0) {
    echo "Data area tidak ditemukan.";
    exit;
}


$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Area Parkir</title>

    <link rel="stylesheet"
          href="../Assets/Css/Tambah.css?v=101">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Edit Area Parkir</h2>

        <form
            action="../Controllers/Edit_AreaController.php"
            method="POST"
        >

            <!-- ID AREA -->

            <input
                type="hidden"
                name="id_area_parkir"
                value="<?php echo $data['Id_area_parkir']; ?>"
            >


            <!-- NAMA AREA -->

            <label>
                Nama Area
            </label>

            <input
                type="text"
                name="nama_area"
                value="<?php echo htmlspecialchars($data['Nama_area']); ?>"
                required
            >


            <!-- KAPASITAS -->

            <label>
                Kapasitas
            </label>

            <input
                type="number"
                name="kapasitas"
                value="<?php echo $data['Kapasitas']; ?>"
                min="1"
                required
            >


            <!-- TOMBOL -->

            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a
                    href="Area_Parkir.php"
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