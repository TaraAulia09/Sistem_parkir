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


// ===============================
// AMBIL DATA PENGGUNA
// ===============================

$ambil_user = mysqli_query(
    $koneksi,
    "SELECT * FROM Tabel_user"
);

if (!$ambil_user) {
    die("Gagal mengambil data: " . mysqli_error($koneksi));
}

$total_user = mysqli_num_rows($ambil_user);


// ===============================
// SEMENTARA
// ===============================

$total_kendaraan = 0;
$total_pendapatan = 0;

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Dashboard Admin - Parkir</title>

    <link rel="stylesheet" href="../Assets/Css/Admin.css">

</head>


<body>

<div class="container">


    <!-- ===============================
         HEADER
    ================================ -->

    <div class="header">

        <h1>Aplikasi Manajemen Parkir</h1>

        <div class="user-info">

            <span>
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </span>

            <a href="Logout.php" class="btn-keluar">
                Keluar
            </a>

        </div>

    </div>



    <!-- ===============================
         RINGKASAN
    ================================ -->

    <div class="grid-box">


        <!-- TOTAL PENGGUNA -->

        <div class="box">

            <h3>Total Pengguna</h3>

            <p class="angka">
                <?php echo $total_user; ?>
            </p>

        </div>



        <!-- TOTAL KENDARAAN -->

        <a href="Kendaraan.php" class="box box-link">

            <h3>Total Kendaraan</h3>

            <p class="angka">
                <?php echo $total_kendaraan; ?>
            </p>

            <span class="lihat">
                Klik untuk melihat
            </span>

        </a>



        <!-- TOTAL PENDAPATAN -->

        <a href="Data_Pendapatan.php" class="box box-link">

            <h3>Total Pendapatan</h3>

            <p class="angka">
                Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?>
            </p>

            <span class="lihat">
                Klik untuk melihat
            </span>

        </a>


    </div>



    <!-- ===============================
         DATA PENGGUNA
    ================================ -->

    <div class="card">


        <div class="judul-tabel">

            <h2>Daftar Pengguna</h2>

            <a href="Tambah_Pengguna.php" class="btn-tambah">
                + Tambah Pengguna
            </a>

        </div>



        <table>


            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama Lengkap</th>

                    <th>Username</th>

                    <th>Peran</th>

                    <th>Aksi</th>

                </tr>

            </thead>



            <tbody>


                <?php

                // Nomor urut tampilan
                $no = 1;

                while ($row = mysqli_fetch_assoc($ambil_user)) :

                ?>


                <tr>


                    <!-- NOMOR URUT -->

                    <td>
                        <?php echo $no++; ?>
                    </td>


                    <!-- NAMA -->

                    <td>
                        <?php echo htmlspecialchars($row['Nama_lengkap']); ?>
                    </td>


                    <!-- USERNAME -->

                    <td>
                        <?php echo htmlspecialchars($row['Username']); ?>
                    </td>


                    <!-- ROLE -->

                    <td>
                        <?php echo htmlspecialchars($row['Role']); ?>
                    </td>


                    <!-- AKSI -->

                    <td>


                        <!-- EDIT -->

                        <a
                            href="Edit_Pengguna.php?id=<?php echo $row['Id_user']; ?>"
                            class="btn-edit">

                            Edit

                        </a>



                        <!-- HAPUS -->

                        <a
                            href="../Controllers/Hapus_PenggunaController.php?id=<?php echo $row['Id_user']; ?>"
                            class="btn-hapus"
                            onclick="return confirm('Yakin ingin menghapus pengguna ini?')">

                            Hapus

                        </a>


                    </td>


                </tr>


                <?php endwhile; ?>


            </tbody>


        </table>


    </div>


</div>


</body>

</html>