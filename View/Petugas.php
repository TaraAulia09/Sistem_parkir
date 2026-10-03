<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: Login.php?pesan=Silakan Login Dulu!");
    exit;
}

if (strtolower($_SESSION['role']) != 'petugas') {
    header("Location: Login.php?pesan=Anda Bukan Petugas!");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Petugas - Parkir</title>

    <link rel="stylesheet"
          href="../Assets/Css/Petugas.css?v=2">

</head>

<body>

<div class="petugas-container">

    <!-- HEADER -->

    <div class="petugas-header">

        <div class="judul">

            <h1>Aplikasi Manajemen Parkir</h1>

            <p>Dashboard Petugas</p>

        </div>

        <div class="petugas-user">

            <span>
                <?php
                echo htmlspecialchars($_SESSION['username']);
                ?>
            </span>

            <a href="Logout.php"
               class="btn-keluar">
                Keluar
            </a>

        </div>

    </div>


    <!-- WELCOME -->

    <div class="welcome-card">

        <div>

            <h2>
                Selamat Datang, Petugas 👋
            </h2>

            <p>
                Kelola transaksi parkir dan cetak struk.
            </p>

        </div>

        <div class="shine-icon">
            👮🏻
        </div>

    </div>


    <!-- MENU -->

    <div class="menu-section">

        <h2>Menu Petugas</h2>

        <div class="menu-grid">


            <!-- TRANSAKSI -->

            <a href="Transaksi.php"
               class="menu-card">

                <div class="menu-icon">
                    🧾
                </div>

                <div class="menu-info">

                    <h3>
                        Transaksi Parkir
                    </h3>

                    <p>
                        Kelola transaksi parkir
                        masuk dan keluar.
                    </p>

                </div>

                <span class="menu-arrow">
                    →
                </span>

            </a>


            <!-- CETAK STRUK -->

            <a href="Cetak_Struk.php"
               class="menu-card">

                <div class="menu-icon">
                    🖨️
                </div>

                <div class="menu-info">

                    <h3>
                        Cetak Struk Parkir
                    </h3>

                    <p>
                        Cetak bukti transaksi
                        parkir.
                    </p>

                </div>

                <span class="menu-arrow">
                    →
                </span>

            </a>


        </div>

    </div>

</div>

</body>

</html>