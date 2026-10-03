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


// =========================
// AMBIL DATA TARIF
// =========================

$ambil_tarif = mysqli_query(
    $koneksi,
    "SELECT *
     FROM Tabel_tarif
     ORDER BY Id_tarif ASC"
);

if (!$ambil_tarif) {
    die(
        "Gagal mengambil data tarif: "
        . mysqli_error($koneksi)
    );
}


// =========================
// TOTAL TARIF
// =========================

$total_tarif = mysqli_num_rows($ambil_tarif);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tarif Parkir - Admin</title>

    <!-- PAKAI CSS YANG SAMA DENGAN PENGGUNA -->

    <link rel="stylesheet" href="../Assets/Css/Kendaraan1.css?v=3">

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
         TOTAL TARIF
    ========================== -->

    <div class="total-card">

        <h2>
            Total Tarif Parkir
        </h2>


        <div class="total-angka">

            <?php
            echo $total_tarif;
            ?>

        </div>

    </div>



    <!-- =========================
         DAFTAR TARIF
    ========================== -->

    <div class="card">


        <div class="judul-tabel">

            <h2>
                Daftar Tarif Parkir
            </h2>


            <a
                href="Tambah_Tarif.php"
                class="btn-tambah"
            >
                + Tambah Tarif
            </a>

        </div>



        <!-- TABLE WRAPPER -->

        <div class="table-wrapper">


            <table>


                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Jenis Kendaraan
                        </th>

                        <th>
                            Tarif Per Jam
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
                    mysqli_num_rows($ambil_tarif) > 0
                ):

                    while (
                        $row =
                        mysqli_fetch_assoc($ambil_tarif)
                    ):

                ?>


                    <tr>


                        <!-- NO -->

                        <td>

                            <?php
                            echo $no++;
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



                        <!-- TARIF -->

                        <td>

                            Rp

                            <?php

                            echo number_format(
                                $row['Tarif_per_jam'],
                                0,
                                ',',
                                '.'
                            );

                            ?>

                        </td>



                        <!-- AKSI -->

                        <td>


                            <a
                                href="Edit_Tarif.php?id=<?php echo $row['Id_tarif']; ?>"
                                class="btn-edit"
                            >
                                Edit
                            </a>


                            <a
                                href="../Controllers/Hapus_TarifController.php?id=<?php echo $row['Id_tarif']; ?>"
                                class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus tarif ini?');"
                            >
                                Hapus
                            </a>


                        </td>


                    </tr>


                <?php

                    endwhile;

                else:

                ?>


                    <tr>

                        <td
                            colspan="4"
                            class="kosong"
                        >
                            Belum ada data tarif.
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