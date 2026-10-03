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


/* AMBIL DATA LOG AKTIVITAS */

$query = mysqli_query(
    $koneksi,
    "SELECT
        l.Id_log,
        l.Id_user,
        u.Nama_lengkap,
        u.Username,
        l.Aktifitas,
        l.Waktu_aktivitas
     FROM Tabel_log_aktivitas AS l
     LEFT JOIN Tabel_user AS u
        ON l.Id_user = u.Id_user
     ORDER BY l.Id_log ASC"
);

if (!$query) {
    die("Gagal mengambil data log aktivitas: " . mysqli_error($koneksi));
}


/* TOTAL LOG */

$total_log = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Log Aktivitas - Parkir</title>

    <link rel="stylesheet" href="../Assets/Css/Kendaraan1.css?v=8">

</head>

<body>

<div class="kendaraan-container">


    <!-- HEADER -->

    <div class="header">

        <div class="judul-aplikasi">

            <h1>Aplikasi Manajemen Parkir</h1>

        </div>


        <div class="user-info">

            <span>
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </span>

            <a href="Admin.php" class="btn-kembali">
                Kembali
            </a>

        </div>

    </div>


    <!-- TOTAL LOG -->

    <div class="total-card">

        <h2>Total Log Aktivitas</h2>

        <div class="total-angka">
            <?php echo $total_log; ?>
        </div>

    </div>


    <!-- TABEL LOG -->

    <div class="card">

        <div class="judul-tabel">

            <h2>Daftar Log Aktivitas</h2>

        </div>


        <div class="table-wrapper log-table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Pengguna</th>

                        <th>Aktivitas</th>

                        <th>Waktu Aktivitas</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $no = 1;

                if (mysqli_num_rows($query) > 0):

                    while ($data = mysqli_fetch_assoc($query)):

                ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>


                        <td>

                            <?php

                            if (!empty($data['Nama_lengkap'])) {

                                echo htmlspecialchars(
                                    $data['Nama_lengkap']
                                );

                            } else {

                                echo "Pengguna tidak ditemukan";

                            }

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $data['Aktifitas']
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $data['Waktu_aktivitas']
                            );

                            ?>

                        </td>

                    </tr>

                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td colspan="4" class="kosong">
                            Belum ada log aktivitas.
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </>

    </div>

</div>

</body>

</html>