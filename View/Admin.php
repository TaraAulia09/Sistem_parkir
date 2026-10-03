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
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Parkir</title>

    <link rel="stylesheet"
          href="../Assets/Css/Admin.css?v=4">

</head>

<body>

<div class="container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="header">

        <div class="judul-aplikasi">

            <h1>Aplikasi Manajemen Parkir</h1>

            <p>Dashboard Admin</p>

        </div>


        <div class="user-info">

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


    <!-- =========================
         WELCOME ADMIN
    ========================== -->

    <div class="welcome-card">

        <div>

            <h2>
                Selamat Datang, Admin 👋
            </h2>

            <p>
                Kelola data dan aktivitas parkir
                melalui dashboard ini.
            </p>

        </div>


        <div class="shine-icon">
            🤵🏻‍♀️
        </div>

    </div>


    <!-- =========================
         JUDUL MENU ADMIN
    ========================== -->

    <div class="menu-section">

        <h2>Menu Admin</h2>

    </div>


    <!-- =========================
         MENU ADMIN
    ========================== -->

    <div class="menu-admin">


        <!-- PENGGUNA -->

        <a href="Pengguna.php"
           class="menu-card">

            <div class="menu-icon">
                👤
            </div>

            <div class="menu-text">

                <h3>
                    Pengguna
                </h3>

                <p>
                    Kelola data pengguna
                </p>

            </div>

            <div class="menu-arrow">
                ›
            </div>

        </a>


        <!-- KENDARAAN -->

        <a href="Kendaraan.php"
           class="menu-card">

            <div class="menu-icon">
                🚗
            </div>

            <div class="menu-text">

                <h3>
                    Kendaraan
                </h3>

                <p>
                    Kelola data kendaraan
                </p>

            </div>

            <div class="menu-arrow">
                ›
            </div>

        </a>


        <!-- TARIF PARKIR -->

        <a href="Tarif.php"
           class="menu-card">

            <div class="menu-icon">
                💰
            </div>

            <div class="menu-text">

                <h3>
                    Tarif Parkir
                </h3>

                <p>
                    Kelola tarif parkir
                </p>

            </div>

            <div class="menu-arrow">
                ›
            </div>

        </a>


        <!-- AREA PARKIR -->

        <a href="Area_Parkir.php"
           class="menu-card">

            <div class="menu-icon">
                🅿️
            </div>

            <div class="menu-text">

                <h3>
                    Area Parkir
                </h3>

                <p>
                    Kelola area parkir
                </p>

            </div>

            <div class="menu-arrow">
                ›
            </div>

        </a>


        <!-- LOG AKTIVITAS -->

        <a href="Log_Aktivitas.php"
           class="menu-card">

            <div class="menu-icon">
                📋
            </div>

            <div class="menu-text">

                <h3>
                    Log Aktivitas
                </h3>

                <p>
                    Lihat aktivitas sistem
                </p>

            </div>

            <div class="menu-arrow">
                ›
            </div>

        </a>


    </div>


</div>

</body>

</html>