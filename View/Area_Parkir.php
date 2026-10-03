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


/* AMBIL DATA AREA */

$ambil_area = mysqli_query(
    $koneksi,
    "SELECT *
     FROM Tabel_area_parkir
     ORDER BY Id_area_parkir ASC"
);

if (!$ambil_area) {
    die("Gagal mengambil data area: " . mysqli_error($koneksi));
}


/* TOTAL AREA */

$total_area = mysqli_num_rows($ambil_area);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-1.0">

    <title>Area Parkir - Admin</title>

    <!-- PAKAI CSS KENDARAAN -->
    <link rel="stylesheet" href="../Assets/Css/Kendaraan1.css?v=4">

</head>

<body>

<div class="kendaraan-container">


    <!-- HEADER -->

    <div class="header">

        <h1>
            Aplikasi Manajemen Parkir
        </h1>

        <div class="user-info">

            <span>
                <?php
                echo htmlspecialchars(
                    $_SESSION['username']
                );
                ?>
            </span>

            <a href="Admin.php"
               class="btn-kembali">

                Kembali

            </a>

        </div>

    </div>


    <!-- TOTAL AREA -->

    <div class="total-card">

        <h2>
            Total Area Parkir
        </h2>

        <p class="total-angka">
            <?php echo $total_area; ?>
        </p>

    </div>


    <!-- DAFTAR AREA -->

    <div class="card">

        <div class="judul-tabel">

            <h2>
                Daftar Area Parkir
            </h2>

            <a href="Tambah_Area.php"
               class="btn-tambah">

                + Tambah Area

            </a>

        </div>
      
        <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama Area</th>

                    <th>Kapasitas</th>

                    <th>Terisi</th>

                    <th>Tersedia</th>

                    <th>Aksi</th>

                </tr>

            </thead>
          


            <tbody>

            <?php if (mysqli_num_rows($ambil_area) > 0): ?>

                <?php
                $no = 1;
                ?>

                <?php while ($row = mysqli_fetch_assoc($ambil_area)): ?>

                    <tr>

                        <!-- NOMOR TAMPILAN -->
                        <td>
                            <?php echo $no++; ?>
                        </td>


                        <!-- NAMA AREA -->
                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['Nama_area']
                            );
                            ?>
                        </td>


                        <!-- KAPASITAS -->
                        <td>
                            <?php
                            echo $row['Kapasitas'];
                            ?>
                        </td>


                        <!-- TERISI -->
                        <td>
                            <?php
                            echo $row['Terisi'];
                            ?>
                        </td>


                        <!-- TERSEDIA -->
                        <td>
                            <?php
                            echo (
                                $row['Kapasitas']
                                -
                                $row['Terisi']
                            );
                            ?>
                        </td>


                        <!-- AKSI -->
                        <td>

                            <a
                                href="Edit_Area.php?id=<?php echo $row['Id_area_parkir']; ?>"
                                class="btn-edit">
                                Edit
                            </a>

                            <a
                                href="../Controllers/Hapus_AreaController.php?id=<?php echo $row['Id_area_parkir']; ?>"
                                class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus area ini?')">
                                Hapus
                            </a>

                        </td>

                    </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6"
                        class="kosong">

                        Belum ada data area parkir.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>