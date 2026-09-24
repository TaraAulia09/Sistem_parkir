<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: Login.php?pesan=Silakan Login Dulu!");
    exit;
}

$role = strtolower($_SESSION['role']);

if ($role != 'pegawai' && $role != 'petugas') {
    header("Location: Login.php?pesan=Anda bukan Petugas!");
    exit;
}

require_once __DIR__ . '/../Config/Koneksi.php';


// ===============================
// DATA TRANSAKSI
// ===============================

$query = mysqli_query(
    $koneksi,
    "SELECT
        t.Id_parkir,
        k.Nama,
        k.Plat_nomor,
        k.Jenis_kendaraan,
        t.Waktu_masuk,
        t.Waktu_keluar,
        t.Biaya_total,
        t.Status

    FROM Tabel_transaksi AS t

    LEFT JOIN Tabel_Kendaraan AS k
        ON t.Id_kendaraan = k.Id_kendaraan

    ORDER BY t.Waktu_masuk DESC"
);

if (!$query) {
    die("Query transaksi gagal: " . mysqli_error($koneksi));
}


// ===============================
// DATA STOK PARKIR
// ===============================

$area_query = mysqli_query(
    $koneksi,
    "SELECT
        Id_area_parkir,
        Nama_area,
        Kapasitas,
        Terisi,
        (Kapasitas - Terisi) AS Tersedia

    FROM Tabel_area_parkir

    ORDER BY Id_area_parkir ASC"
);

if (!$area_query) {
    die("Query stok parkir gagal: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Petugas</title>

    <link rel="stylesheet"
          href="../Assets/Css/Petugas.css">

</head>


<body>


<!-- ================= HEADER ================= -->

<header class="header">

    <div class="logo">
        Parkir
    </div>

    <div class="user-area">

        <span>
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>

        <a href="Logout.php">
            Logout
        </a>

    </div>

</header>



<!-- ================= CONTENT ================= -->

<main class="container">


    <div class="work-title">
        Dashboard Petugas
    </div>



    <!-- ================= MENU ================= -->

    <div class="menu-grid">


        <!-- TRANSAKSI -->

        <div class="menu-card">

            <div class="card-icon">
                📋
            </div>

            <h2>
                Transaksi
            </h2>

            <p>
                Catat kendaraan masuk dan
                proses kendaraan keluar.
            </p>

            <a href="#" class="btn-menu">
                Buka Transaksi
            </a>

        </div>



        <!-- STOK PARKIR -->

        <div class="menu-card">

            <div class="card-icon">
                🅿️
            </div>

            <h2>
                Cek Stok Parkir
            </h2>

            <p>
                Lihat kapasitas dan slot
                parkir yang tersedia.
            </p>

            <button
                type="button"
                class="btn-menu stock-button"
                id="stockButton">

                Lihat Stok Parkir

            </button>

        </div>

    </div>



    <!-- ================= STOK PARKIR ================= -->

    <div
        class="stock-card"
        id="stockCard"
        style="display: none;">

        <div class="section-title">

            <h2>
                🅿️ Stok Parkir
            </h2>

            <button
                type="button"
                id="closeStock">

                Tutup

            </button>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>Area</th>

                        <th>Kapasitas</th>

                        <th>Terisi</th>

                        <th>Tersedia</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (mysqli_num_rows($area_query) > 0): ?>

                    <?php while ($area = mysqli_fetch_assoc($area_query)): ?>

                        <tr>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $area['Nama_area']
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $area['Kapasitas']
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $area['Terisi']
                                );
                                ?>
                            </td>


                            <td class="tersedia">

                                <?php
                                echo htmlspecialchars(
                                    $area['Tersedia']
                                );
                                ?>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="4"
                            class="kosong">

                            Belum ada data area parkir.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>



    <!-- ================= TRANSAKSI ================= -->

    <div class="transaction-card">


        <div class="transaction-title">

            <h2>
                📋 Transaksi Hari Ini
            </h2>

        </div>



        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>Nama</th>

                        <th>Plat Nomor</th>

                        <th>Jenis</th>

                        <th>Waktu Masuk</th>

                        <th>Waktu Keluar</th>

                        <th>Biaya</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>


                <?php if (mysqli_num_rows($query) > 0): ?>


                    <?php while ($data = mysqli_fetch_assoc($query)): ?>


                        <tr>


                            <!-- NAMA -->

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $data['Nama'] ?? '-'
                                );

                                ?>

                            </td>



                            <!-- PLAT -->

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $data['Plat_nomor'] ?? '-'
                                );

                                ?>

                            </td>



                            <!-- JENIS -->

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $data['Jenis_kendaraan'] ?? '-'
                                );

                                ?>

                            </td>



                            <!-- WAKTU MASUK -->

                            <td>

                                <?php

                                if (!empty($data['Waktu_masuk'])) {

                                    echo date(
                                        'H:i',
                                        strtotime(
                                            $data['Waktu_masuk']
                                        )
                                    );

                                } else {

                                    echo '-';

                                }

                                ?>

                            </td>



                            <!-- WAKTU KELUAR -->

                            <td>

                                <?php

                                if (!empty($data['Waktu_keluar'])) {

                                    echo date(
                                        'H:i',
                                        strtotime(
                                            $data['Waktu_keluar']
                                        )
                                    );

                                } else {

                                    echo '-';

                                }

                                ?>

                            </td>



                            <!-- BIAYA -->

                            <td class="biaya">

                                <?php

                                if (
                                    $data['Biaya_total'] !== null &&
                                    $data['Biaya_total'] !== ''
                                ) {

                                    echo 'Rp ' .
                                        number_format(
                                            $data['Biaya_total'],
                                            0,
                                            ',',
                                            '.'
                                        );

                                } else {

                                    echo '-';

                                }

                                ?>

                            </td>



                            <!-- STATUS -->

                            <td>

                                <?php

                                $status =
                                    strtolower(
                                        trim(
                                            $data['Status'] ?? ''
                                        )
                                    );


                                if ($status == 'keluar') {

                                    echo '<span class="status selesai">
                                            Selesai
                                          </span>';

                                } elseif ($status == 'masuk') {

                                    echo '<span class="status masuk">
                                            Masuk
                                          </span>';

                                } else {

                                    echo '<span class="status">
                                            -
                                          </span>';

                                }

                                ?>

                            </td>


                        </tr>


                    <?php endwhile; ?>


                <?php else: ?>


                    <tr>

                        <td
                            colspan="7"
                            class="kosong">

                            Belum ada transaksi.

                        </td>

                    </tr>


                <?php endif; ?>


                </tbody>

            </table>

        </div>

    </div>


</main>



<!-- ================= JAVASCRIPT ================= -->

<script>

const stockButton =
    document.getElementById("stockButton");

const stockCard =
    document.getElementById("stockCard");

const closeStock =
    document.getElementById("closeStock");


// BUKA STOK

stockButton.addEventListener(
    "click",
    function () {

        stockCard.style.display = "block";

        stockCard.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });

    }
);


// TUTUP STOK

closeStock.addEventListener(
    "click",
    function () {

        stockCard.style.display = "none";

    }
);

</script>


</body>

</html>