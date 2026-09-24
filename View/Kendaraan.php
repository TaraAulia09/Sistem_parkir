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

$ambil_kendaraan = mysqli_query(
    $koneksi,
    "SELECT * FROM Tabel_kendaraan ORDER BY Id_kendaraan ASC"
);

if (!$ambil_kendaraan) {
    die("Gagal mengambil data kendaraan: " . mysqli_error($koneksi));
}

$total_kendaraan = mysqli_num_rows($ambil_kendaraan);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Data Kendaraan</title>

    <link rel="stylesheet" href="../Assets/Css/Kendaraan.css">

</head>

<body>

<div class="container">


    <!-- HEADER -->

    <div class="header">

        <h1>Aplikasi Manajemen Parkir</h1>

        <div class="user-info">

            <span>
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </span>

            <a href="Admin.php" class="btn-kembali">
                Kembali
            </a>

        </div>

    </div>


    <!-- TOTAL -->

    <div class="total-card">

        <h2>Total Kendaraan</h2>

        <div class="total-angka">
            <?php echo $total_kendaraan; ?>
        </div>

    </div>


    <!-- DATA KENDARAAN -->

    <div class="card">

        <div class="judul-tabel">

            <h2>Daftar Parkir</h2>

            <a href="Tambah_Kendaraan.php" class="btn-tambah">
                + Tambah Kendaraan
            </a>

        </div>


        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis Kendaraan</th>
                    <th>Warna</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>

            </thead>


            <tbody>

                <?php

                $no = 1;

                while ($row = mysqli_fetch_assoc($ambil_kendaraan)) :

                ?>

                <tr>

                    <td>
                        <?php echo $no++; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['Plat_nomor']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['Jenis_kendaraan']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['Warna']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['Pemilik']); ?>
                    </td>

                    <td>

                        <a
                            href="Edit_Kendaraan.php?id=<?php echo $row['Id_kendaraan']; ?>"
                            class="btn-edit">
                            Edit
                        </a>

                        <a
                            href="../Controllers/Hapus_KendaraanController.php?id=<?php echo $row['Id_kendaraan']; ?>"
                            class="btn-hapus"
                            onclick="return confirm('Yakin ingin menghapus kendaraan ini?')">
                            Hapus
                        </a>

                    </td>

                </tr>

                <?php endwhile; ?>


                <?php if ($total_kendaraan == 0) : ?>

                <tr>

                    <td colspan="6" class="kosong">
                        Belum ada data kendaraan.
                    </td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>