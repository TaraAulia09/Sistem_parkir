<?php

session_start();

require_once "../Config/Koneksi.php";
require_once "../Controllers/TransaksiController.php";


/* =========================
   CEK LOGIN PETUGAS
========================= */

if (!isset($_SESSION['role'])) {
    header(
        "Location: Login.php?pesan=Silakan Login Dulu!"
    );
    exit;
}

if (
    strtolower($_SESSION['role'])
    != 'petugas'
) {
    header(
        "Location: Login.php?pesan=Anda Bukan Petugas!"
    );
    exit;
}


/* =========================
   CONTROLLER
========================= */

$controller =
    new TransaksiController($koneksi);

$id_user =
    $_SESSION['id_user'] ?? 0;


/* =========================
   PROSES SIMPAN MASUK
========================= */

if (isset($_POST['simpan_masuk'])) {

    $controller->simpanMasuk(
        $id_user
    );
}


/* =========================
   PROSES KENDARAAN KELUAR
========================= */

if (isset($_GET['keluar'])) {

    $controller->prosesKeluar();
}


/* =========================
   AMBIL DATA
========================= */

$query_kendaraan =
    $controller->getKendaraan();

$query_area =
    $controller->getArea();

$query_transaksi =
    $controller->getTransaksi();

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Transaksi Parkir</title>

    <link
        rel="stylesheet"
        href="../Assets/Css/Transaksi.css?v=3">

</head>

<body>

<div class="transaksi-container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="transaksi-header">

        <div>

            <h1>
                Aplikasi Manajemen Parkir
            </h1>

            <p>
                Transaksi Parkir
            </p>

        </div>


        <div class="header-kanan">

            <span>
                <?php
                echo htmlspecialchars(
                    $_SESSION['username']
                );
                ?>
            </span>


            <a
                href="Petugas.php"
                class="btn-kembali">

                ← Kembali

            </a>


            <a
                href="Logout.php"
                class="btn-keluar">

                Keluar

            </a>

        </div>

    </div>


    <!-- =========================
         JUDUL
    ========================== -->

    <div class="judul-halaman">

        <h2>
            Transaksi Parkir
        </h2>

        <p>
            Kelola kendaraan yang masuk
            dan keluar area parkir.
        </p>

    </div>


    <!-- =========================
         PESAN
    ========================== -->

    <?php if (isset($_GET['pesan'])): ?>

        <div class="pesan">

            <?php
            echo htmlspecialchars(
                $_GET['pesan']
            );
            ?>

        </div>

    <?php endif; ?>


    <!-- =========================
         TAMBAH TRANSAKSI MASUK
    ========================== -->

    <div class="form-card">

        <div class="card-title">

            <h2>
                🚗 Transaksi Parkir Masuk
            </h2>

            <p>
                Pilih kendaraan dan area parkir.
            </p>

        </div>


        <form method="POST">


            <div class="form-grid">


                <!-- KENDARAAN -->

                <div class="form-group">

                    <label>
                        Kendaraan
                    </label>


                    <select
                        name="id_kendaraan"
                        required>

                        <option value="">
                            -- Pilih Kendaraan --
                        </option>


                        <?php
                        if (
                            $query_kendaraan
                            && mysqli_num_rows(
                                $query_kendaraan
                            ) > 0
                        ):

                            while (
                                $kendaraan =
                                mysqli_fetch_assoc(
                                    $query_kendaraan
                                )
                            ):
                        ?>

                            <option
                                value="<?php
                                echo $kendaraan[
                                    'Id_kendaraan'
                                ];
                                ?>">

                                <?php
                                echo htmlspecialchars(
                                    $kendaraan[
                                        'Plat_nomor'
                                    ]
                                    . " - "
                                    . $kendaraan[
                                        'Jenis_kendaraan'
                                    ]
                                    . " - "
                                    . $kendaraan[
                                        'Pemilik'
                                    ]
                                );
                                ?>

                            </option>

                        <?php
                            endwhile;

                        endif;
                        ?>

                    </select>

                </div>


                <!-- AREA -->

                <div class="form-group">

                    <label>
                        Area Parkir
                    </label>


                    <select
                        name="id_area"
                        required>

                        <option value="">
                            -- Pilih Area --
                        </option>


                        <?php
                        if (
                            $query_area
                            && mysqli_num_rows(
                                $query_area
                            ) > 0
                        ):

                            while (
                                $area =
                                mysqli_fetch_assoc(
                                    $query_area
                                )
                            ):

                                $tersedia =
                                    $area['Kapasitas']
                                    -
                                    $area['Terisi'];
                        ?>

                            <option
                                value="<?php
                                echo $area[
                                    'Id_area_parkir'
                                ];
                                ?>"
                                <?php
                                echo (
                                    $tersedia <= 0
                                )
                                ? 'disabled'
                                : '';
                                ?>>

                                <?php
                                echo htmlspecialchars(
                                    $area['Nama_area']
                                    . " (Tersedia: "
                                    . $tersedia
                                    . ")"
                                );
                                ?>

                            </option>

                        <?php
                            endwhile;

                        endif;
                        ?>

                    </select>

                </div>

            </div>


            <div class="form-action">

                <button
                    type="submit"
                    name="simpan_masuk"
                    class="btn-simpan">

                    + Simpan Kendaraan Masuk

                </button>

            </div>

        </form>

    </div>


    <!-- =========================
         DATA TRANSAKSI
    ========================== -->

    <div class="table-card">

        <div class="card-title">

            <h2>
                📋 Data Transaksi Parkir
            </h2>

            <p>
                Data transaksi yang tersimpan
                di database.
            </p>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>
                            Plat Nomor
                        </th>

                        <th>
                            Jenis Kendaraan
                        </th>

                        <th>
                            Warna
                        </th>

                        <th>
                            Pemilik
                        </th>

                        <th>
                            Waktu Masuk
                        </th>

                        <th>
                            Waktu Keluar
                        </th>

                        <th>
                            Durasi
                        </th>

                        <th>
                            Biaya
                        </th>

                        <th>
                            Status
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
                    $query_transaksi
                    &&
                    mysqli_num_rows(
                        $query_transaksi
                    ) > 0
                ):

                    while (
                        $data =
                        mysqli_fetch_assoc(
                            $query_transaksi
                        )
                    ):

                ?>

                    <tr>


                        <!-- NO -->

                        <td>

                            <?php
                            echo $no++;
                            ?>

                        </td>


                        <!-- PLAT -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $data[
                                    'Plat_nomor'
                                ]
                                ?? '-'
                            );
                            ?>

                        </td>


                        <!-- JENIS -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $data[
                                    'Jenis_kendaraan'
                                ]
                                ?? '-'
                            );
                            ?>

                        </td>


                        <!-- WARNA -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $data[
                                    'Warna'
                                ]
                                ?? '-'
                            );
                            ?>

                        </td>


                        <!-- PEMILIK -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $data[
                                    'Pemilik'
                                ]
                                ?? '-'
                            );
                            ?>

                        </td>


                        <!-- WAKTU MASUK -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $data[
                                    'Waktu_masuk'
                                ]
                                ?? '-'
                            );
                            ?>

                        </td>


                        <!-- WAKTU KELUAR -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $data[
                                    'Waktu_keluar'
                                ]
                                ?? '-'
                            );
                            ?>

                        </td>


                        <!-- DURASI -->

                        <td>

                            <?php

                            if (
                                $data[
                                    'Durasi_jam'
                                ] !== null
                            ) {

                                echo
                                    $data[
                                        'Durasi_jam'
                                    ]
                                    . " jam";

                            } else {

                                echo "-";

                            }

                            ?>

                        </td>


                        <!-- BIAYA -->

                        <td>

                            <?php

                            if (
                                $data[
                                    'Biaya_total'
                                ] !== null
                                &&
                                $data[
                                    'Biaya_total'
                                ] > 0
                            ) {

                                echo
                                    'Rp'
                                    .
                                    number_format(
                                        $data[
                                            'Biaya_total'
                                        ],
                                        0,
                                        ',',
                                        '.'
                                    );

                            } else {

                                echo "-";

                            }

                            ?>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <?php
                            if (
                                strtolower(
                                    $data['Status']
                                )
                                == 'masuk'
                            ):
                            ?>

                                <span
                                    class="status masuk">

                                    Masuk

                                </span>

                            <?php else: ?>

                                <span
                                    class="status keluar">

                                    Keluar

                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- AKSI -->

                        <td>

                            <?php
                            if (
                                strtolower(
                                    $data['Status']
                                )
                                == 'masuk'
                            ):
                            ?>

                                <a
                                    href="Transaksi.php?keluar=<?php
                                    echo $data[
                                        'Id_parkir'
                                    ];
                                    ?>"
                                    class="btn-keluar-kendaraan"
                                    onclick="
                                        return confirm(
                                            'Yakin kendaraan ini keluar?'
                                        );
                                    ">

                                    Keluar

                                </a>

                            <?php else: ?>

                                <span
                                    class="selesai">

                                    Selesai

                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td
                            colspan="11"
                            class="data-kosong">

                            Belum ada transaksi parkir.

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
