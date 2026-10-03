<?php

session_start();

require_once "../Config/Koneksi.php";
require_once "../Controllers/CetakStrukController.php";


// =========================
// CEK LOGIN PETUGAS
// =========================

if (!isset($_SESSION['role'])) {
    header("Location: Login.php?pesan=Silakan Login Dulu!");
    exit;
}

if (strtolower($_SESSION['role']) != 'petugas') {
    header("Location: Login.php?pesan=Anda Bukan Petugas!");
    exit;
}


// =========================
// BUAT CONTROLLER
// =========================

$controller = new CetakStrukController($koneksi);


// =========================
// AMBIL DATA
// =========================

$struk = $controller->prosesStruk();

$query_transaksi = $controller->getTransaksiKeluar();

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Cetak Struk Parkir</title>

    <link rel="stylesheet"
          href="../Assets/Css/Cetak_Struk.css?v=2">

</head>

<body>

<div class="struk-container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="struk-header no-print">

        <div>

            <h1>Aplikasi Manajemen Parkir</h1>

            <p>Cetak Struk Parkir</p>

        </div>

        <div class="header-kanan">

            <span>
                <?php
                echo htmlspecialchars(
                    $_SESSION['username']
                );
                ?>
            </span>

            <a href="Petugas.php"
               class="btn-kembali">
                ← Kembali
            </a>

            <a href="Logout.php"
               class="btn-keluar">
                Keluar
            </a>

        </div>

    </div>


    <!-- =========================
         DAFTAR TRANSAKSI
    ========================== -->

    <?php if ($struk === null): ?>

    <div class="list-card no-print">

        <div class="card-title">

            <h2>🖨️ Cetak Struk Parkir</h2>

            <p>
                Pilih transaksi yang ingin dicetak.
            </p>

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
                        <th>Biaya</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $no = 1;

                if (
                    $query_transaksi &&
                    mysqli_num_rows($query_transaksi) > 0
                ):

                    while (
                        $data = mysqli_fetch_assoc(
                            $query_transaksi
                        )
                    ):

                ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
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

                            <a
                                href="Cetak_Struk.php?id=<?php echo $data['Id_parkir']; ?>"
                                class="btn-cetak">

                                🖨️ Cetak

                            </a>

                        </td>

                    </tr>

                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td
                            colspan="9"
                            class="data-kosong">

                            Belum ada transaksi yang selesai.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <?php endif; ?>


    <!-- =========================
         DETAIL STRUK
    ========================== -->

    <?php if ($struk): ?>

    <div class="receipt-area">

        <div class="receipt">

            <div class="receipt-header">

                <h2>STRUK PARKIR</h2>

                <p>Aplikasi Manajemen Parkir</p>

            </div>


            <div class="garis"></div>


            <div class="receipt-info">

                <div>
                    <span>No. Transaksi</span>

                    <strong>
                        #<?php
                        echo $struk['Id_parkir'];
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Plat Nomor</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Plat_nomor'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Jenis Kendaraan</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Jenis_kendaraan'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Warna</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Warna'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Pemilik</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Pemilik'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Area Parkir</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Nama_area'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Waktu Masuk</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Waktu_masuk'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Waktu Keluar</span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $struk['Waktu_keluar'] ?? '-'
                        );
                        ?>
                    </strong>
                </div>


                <div>
                    <span>Durasi</span>

                    <strong>
                        <?php
                        echo $struk['Durasi_jam'];
                        ?> jam
                    </strong>
                </div>


                <div>
                    <span>Tarif / Jam</span>

                    <strong>
                        Rp<?php
                        echo number_format(
                            $struk['Tarif_per_jam'] ?? 0,
                            0,
                            ',',
                            '.'
                        );
                        ?>
                    </strong>
                </div>

            </div>


            <div class="garis"></div>


            <div class="total">

                <span>TOTAL BAYAR</span>

                <strong>
                    Rp<?php
                    echo number_format(
                        $struk['Biaya_total'] ?? 0,
                        0,
                        ',',
                        '.'
                    );
                    ?>
                </strong>

            </div>


            <div class="status-struk">

                Status:

                <strong>
                    <?php
                    echo htmlspecialchars(
                        $struk['Status']
                    );
                    ?>
                </strong>

            </div>


            <div class="receipt-footer">

                <p>Terima kasih telah menggunakan</p>

                <p>layanan parkir kami.</p>

            </div>


            <!-- =========================
                 TOMBOL CETAK
            ========================== -->

            <div class="print-button no-print">

                <button
                    type="button"
                    onclick="window.print()">

                    🖨️ Cetak Struk

                </button>

                <a href="Cetak_Struk.php">

                    ← Kembali ke Daftar

                </a>

            </div>

        </div>

    </div>

    <?php endif; ?>


</div>

</body>

</html>