<?php

session_start();

require_once "../Config/Koneksi.php";
require_once "../Controllers/OwnerController.php";


// =========================
// CONTROLLER
// =========================

$controller = new OwnerController($koneksi);


// =========================
// CEK AKSES OWNER
// =========================

$controller->cekAkses();


// =========================
// TANGGAL DEFAULT
// =========================

$tanggal_mulai = $_GET['tanggal_mulai']
    ?? date('Y-m-01');

$tanggal_akhir = $_GET['tanggal_akhir']
    ?? date('Y-m-d');


// =========================
// DATA REKAP
// =========================

$query_rekap = $controller->getRekap(
    $tanggal_mulai,
    $tanggal_akhir
);

$total_transaksi =
    $controller->getTotalTransaksi(
        $tanggal_mulai,
        $tanggal_akhir
    );

$total_pendapatan =
    $controller->getTotalPendapatan(
        $tanggal_mulai,
        $tanggal_akhir
    );

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Rekap Transaksi - Owner</title>

    <link rel="stylesheet"
          href="../Assets/Css/Owner.css?v=2">

</head>

<body>

<div class="owner-container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="owner-header">

        <div class="judul">

            <h1>Aplikasi Manajemen Parkir</h1>

            <p>Rekap Transaksi Berdasarkan Waktu</p>

        </div>


        <div class="owner-user">

            <span>
                <?php
                echo htmlspecialchars(
                    $_SESSION['username']
                );
                ?>
            </span>

            <a href="Logout.php"
               class="btn-keluar">
                Keluar
            </a>

        </div>

    </div>


    <!-- =========================
         WELCOME
    ========================== -->

    <div class="welcome-card">

        <div>

            <h2>
                Selamat Datang, Owner 👋
            </h2>

            <p>
                Lihat rekap transaksi parkir
                berdasarkan periode waktu.
            </p>

        </div>


        <div class="shine-icon">
            🤵🏻‍♀️
        </div>

    </div>


    <!-- =========================
         FILTER WAKTU
    ========================== -->

    <div class="transaksi-card">

        <div class="transaksi-header">

            <div>

                <h2>
                    📅 Rekap Transaksi
                </h2>

                <p>
                    Pilih periode waktu untuk melihat
                    data transaksi.
                </p>

            </div>

        </div>


        <form method="GET"
              action="Owner.php"
              class="filter-form">

            <div class="filter-group">

                <label for="tanggal_mulai">
                    Tanggal Mulai
                </label>

                <input
                    type="date"
                    id="tanggal_mulai"
                    name="tanggal_mulai"
                    value="<?php
                    echo htmlspecialchars(
                        $tanggal_mulai
                    );
                    ?>"
                    required
                >

            </div>


            <div class="filter-group">

                <label for="tanggal_akhir">
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    id="tanggal_akhir"
                    name="tanggal_akhir"
                    value="<?php
                    echo htmlspecialchars(
                        $tanggal_akhir
                    );
                    ?>"
                    required
                >

            </div>


            <div class="filter-action">

                <button type="submit">
                    🔍 Tampilkan Rekap
                </button>

            </div>

        </form>

    </div>


    <!-- =========================
         RINGKASAN
    ========================== -->

    <div class="statistik">

        <div class="stat-card">

            <div class="stat-icon">
                🧾
            </div>

            <div class="stat-info">

                <p>
                    Total Transaksi
                </p>

                <h2>
                    <?php
                    echo $total_transaksi;
                    ?>
                </h2>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                💰
            </div>

            <div class="stat-info">

                <p>
                    Total Pendapatan
                </p>

                <h2>
                    Rp
                    <?php
                    echo number_format(
                        $total_pendapatan,
                        0,
                        ',',
                        '.'
                    );
                    ?>
                </h2>

            </div>

        </div>

    </div>


    <!-- =========================
         DATA REKAP
    ========================== -->

    <div class="transaksi-card">

        <div class="transaksi-header">

            <div>

                <h2>
                    📊 Hasil Rekap Transaksi
                </h2>

                <p>
                    Periode
                    <?php
                    echo htmlspecialchars(
                        $tanggal_mulai
                    );
                    ?>
                    sampai
                    <?php
                    echo htmlspecialchars(
                        $tanggal_akhir
                    );
                    ?>
                </p>

            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Plat Nomor</th>

                        <th>Jenis Kendaraan</th>

                        <th>Warna</th>

                        <th>Pemilik</th>

                        <th>Waktu Masuk</th>

                        <th>Waktu Keluar</th>

                        <th>Durasi</th>

                        <th>Biaya</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $no = 1;

                if (
                    $query_rekap &&
                    mysqli_num_rows($query_rekap) > 0
                ):

                    while (
                        $data =
                        mysqli_fetch_assoc(
                            $query_rekap
                        )
                    ):

                ?>

                    <tr>

                        <td>
                            <?php
                            echo $no++;
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Plat_nomor'] ?? '-'
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Jenis_kendaraan'] ?? '-'
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Warna'] ?? '-'
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Pemilik'] ?? '-'
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Waktu_masuk'] ?? '-'
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Waktu_keluar'] ?? '-'
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Durasi_jam'] ?? '0'
                            );
                            ?>
                            jam
                        </td>


                        <td>
                            Rp<?php
                            echo number_format(
                                $data['Biaya_total'] ?? 0,
                                0,
                                ',',
                                '.'
                            );
                            ?>
                        </td>


                        <td>

                            <?php

                            if (
                                strtolower(
                                    $data['Status'] ?? ''
                                ) == 'keluar'
                            ) {

                                echo '<span class="status selesai">
                                        Selesai
                                      </span>';

                            } else {

                                echo '<span class="status masuk">
                                        Masuk
                                      </span>';

                            }

                            ?>

                        </td>

                    </tr>


                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td
                            colspan="10"
                            class="kosong">

                            Tidak ada transaksi
                            pada periode tersebut.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


</div>

</body>

</html>