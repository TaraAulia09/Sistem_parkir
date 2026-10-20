<?php

session_start();

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Controllers/C_Log_Aktivitas.php';

$controller = new C_Log_Aktivitas($koneksi);
$controller->cekAkses();

$dataLog = $controller->index();

$logs = $dataLog['logs'];
$total_log = $dataLog['total_log'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log Aktivitas - Parkir</title>

    <link rel="stylesheet"
          href="../Assets/Css/CRUD.css?v=5">
</head>

<body>

<div class="kendaraan-container">

    <div class="header">

        <div class="judul-aplikasi">
            <h1>Aplikasi Manajemen Parkir</h1>
        </div>

        <div class="user-info">

            <span>
                <?php
                echo htmlspecialchars($_SESSION['username']);
                ?>
            </span>

            <a href="Admin.php" class="btn-kembali">
                Kembali
            </a>

        </div>

    </div>

    <div class="total-card">

        <h2>Total Log Aktivitas</h2>

        <div class="total-angka">
            <?php echo $total_log; ?>
        </div>

    </div>

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

                <?php if (!empty($logs)): ?>

                    <?php $no = 1; ?>

                    <?php foreach ($logs as $log): ?>

                        <tr>

                            <td>
                                <?php echo $no++; ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $log['Nama_lengkap']
                                    ?: 'Pengguna tidak ditemukan'
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $log['Aktifitas'] ?? ''
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $log['Waktu_aktivitas'] ?? ''
                                );
                                ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="4" class="kosong">
                            Belum ada log aktivitas.
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