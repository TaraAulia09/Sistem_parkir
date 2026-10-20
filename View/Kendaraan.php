<?php
session_start();

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Controllers/C_Kendaraan.php';

// Cek login
if (!isset($_SESSION['role'])) {
    header(
        "Location: Login.php?pesan=" .
        urlencode("Silakan Login Dulu!")
    );
    exit;
}

// Cek hak akses Admin
if (strtolower($_SESSION['role']) !== 'admin') {
    header(
        "Location: Login.php?pesan=" .
        urlencode("Anda Bukan Admin!")
    );
    exit;
}

// Panggil Controller
$controller = new C_Kendaraan($koneksi);
$ambil_kendaraan = $controller->getAllKendaraan();

if (!$ambil_kendaraan) {
    die("Gagal mengambil data kendaraan.");
}

// Hitung total kendaraan
$total_kendaraan = mysqli_num_rows($ambil_kendaraan);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Data Kendaraan - Admin</title>

    <!-- CSS SAMA DENGAN PENGGUNA -->
    <link rel="stylesheet" href="../Assets/Css/CRUD.css?v=2">
    

</head>


<body>


<div class="kendaraan-container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="header">

        <div class="judul-aplikasi">

            <h1>
                Aplikasi Manajemen Parkir
            </h1>

        </div>


        <div class="user-info">

            <span>
                <?php
                echo htmlspecialchars(
                    $_SESSION['username']
                );
                ?>
            </span>


            <a
                href="Admin.php"
                class="btn-kembali"
            >
                Kembali
            </a>

        </div>

    </div>



    <!-- =========================
         TOTAL KENDARAAN
    ========================== -->

    <div class="total-card">

        <h2>
            Total Kendaraan
        </h2>


        <div class="total-angka">

            <?php
            echo $total_kendaraan;
            ?>

        </div>

    </div>



    <!-- =========================
         DAFTAR KENDARAAN
    ========================== -->

    <div class="card">

        <div class="judul-tabel">

            <h2>
                Daftar Kendaraan
            </h2>


            <a
                href="Tambah_Kendaraan.php"
                class="btn-tambah"
            >
                + Tambah Kendaraan
            </a>

        </div>



        <!-- =========================
             TABLE WRAPPER
        ========================== -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Plat Nomor
                        </th>

                        <th>
                           Kendaraan
                        </th>

                        <th>
                            Warna
                        </th>

                        <th>
                            Pemilik
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $no = 1;

                if (
                    mysqli_num_rows($ambil_kendaraan) > 0
                ):

                    while (
                        $row =
                        mysqli_fetch_assoc($ambil_kendaraan)
                    ):

                ?>

                    <tr>

                        <!-- NO -->

                        <td>
                            <?php
                            echo $no++;
                            ?>
                        </td>


                        <!-- PLAT NOMOR -->

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['Plat_nomor']
                            );
                            ?>
                        </td>


                        <!-- JENIS KENDARAAN -->

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['Jenis_kendaraan']
                            );
                            ?>
                        </td>


                        <!-- WARNA -->

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['Warna']
                            );
                            ?>
                        </td>


                        <!-- PEMILIK -->

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['Pemilik']
                            );
                            ?>
                        </td>


                        <!-- AKSI -->

                        <td>

                            <a
                                href="Edit_Kendaraan.php?id=<?php echo $row['Id_kendaraan']; ?>"
                                class="btn-edit"
                            >
                                Edit
                            </a>


                            <a
    href="../Controllers/Hapus_KendaraanController.php?id=<?php echo $row['Id_kendaraan']; ?>"
    class="btn-hapus"
    onclick="return confirm('Yakin ingin menghapus kendaraan ini?');"

  > Hapus
                            </a>
                        </td>

                    </tr>


                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td
                            colspan="6"
                            class="kosong"
                        >
                            Belum ada data kendaraan.
                        </td>

                    </tr>

                <?php

                endif;

                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


</body>

</html>