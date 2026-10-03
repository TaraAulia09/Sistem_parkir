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


/* TOTAL PENGGUNA */

$ambil_user = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM Tabel_user"
);

if (!$ambil_user) {
    die("Gagal menghitung pengguna: " . mysqli_error($koneksi));
}

$data_total = mysqli_fetch_assoc($ambil_user);

$total_pengguna = $data_total['total'];


/* AMBIL DATA PENGGUNA */

$query = mysqli_query(
    $koneksi,
    "SELECT Id_user, Nama_lengkap, Username, Role
     FROM Tabel_user
     ORDER BY Id_user ASC"
);

if (!$query) {
    die("Gagal mengambil data pengguna: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Pengguna - Parkir</title>

    <link rel="stylesheet" href="../Assets/Css/Kendaraan1.css?v=2">

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
      <!-- ================= WELCOME ================= -->

    <div class="welcome-card">
    <div>


    <!-- TOTAL PENGGUNA -->

    <div class="total-card">

        <h2>Total Pengguna</h2>

        <div class="total-angka">
            <?php echo $total_pengguna; ?>
        </div>

    </div>


    <!-- DAFTAR PENGGUNA -->

    <div class="card">

        <div class="judul-tabel">

            <h2>Daftar Pengguna</h2>

            <a href="Tambah_Pengguna.php"
               class="btn-tambah">

                + Tambah Pengguna

            </a>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Lengkap</th>

                        <th>Username</th>

                        <th>Role</th>

                        <th>Aksi</th>

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
                            echo htmlspecialchars(
                                $data['Nama_lengkap']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Username']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $data['Role']
                            );
                            ?>
                        </td>

                        <td>

                            <a
                                href="Edit_Pengguna.php?id=<?php echo $data['Id_user']; ?>"
                                class="btn-edit"
                            >
                                Edit
                            </a>

                            <a
                                href="../Controllers/Hapus_PenggunaController.php?id=<?php echo $data['Id_user']; ?>"
                                class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus pengguna ini?');"
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

                        <td colspan="5" class="kosong">
                            Belum ada data pengguna.
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</>

</body>
</html>