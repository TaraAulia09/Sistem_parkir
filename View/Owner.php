<?php
session_start();

require_once "../Config/Koneksi.php";
require_once "../Controllers/C_Owner.php";

$controller = new C_Owner($koneksi);
$controller->cekAkses();

$tanggal_mulai = $_GET['tanggal_mulai'] ?? date('Y-m-01');
$tanggal_akhir = $_GET['tanggal_akhir'] ?? date('Y-m-d');

$nama_area = $_GET['nama_area'] ?? '';

if (!in_array($nama_area, ['', 'A', 'B'], true)) {
    $nama_area = '';
}

$query_rekap = $controller->getRekap(
    $tanggal_mulai,
    $tanggal_akhir,
    $nama_area
);

$total_transaksi = $controller->getTotalTransaksi(
    $tanggal_mulai,
    $tanggal_akhir
);

$total_pendapatan = $controller->getTotalPendapatan(
    $tanggal_mulai,
    $tanggal_akhir
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Transaksi - Owner</title>
    <link rel="stylesheet" href="../Assets/Css/Owner.css?v=3">
</head>

<body>
<div class="owner-container">

    <div class="owner-header">
        <div class="judul">
            <h1>Aplikasi Manajemen Parkir</h1>
            <p>Rekap Transaksi Berdasarkan Waktu</p>
        </div>

        <div class="owner-user">
            <span>
                <?php echo htmlspecialchars($_SESSION['username'] ?? 'Owner'); ?>
            </span>

            <a href="Logout.php" class="btn-keluar">Keluar</a>
        </div>
    </div>

    <div class="welcome-card">
        <div>
            <h2>Selamat Datang, Owner 👋</h2>
            <p>Lihat rekap transaksi parkir berdasarkan periode waktu.</p>
        </div>

        <div class="shine-icon">🤵🏻‍♀️</div>
    </div>

    <div class="transaksi-card">
        <div class="transaksi-header">
            <div>
                <h2>📅 Rekap Transaksi</h2>
                <p>Pilih periode waktu dan area parkir untuk melihat data transaksi.</p>
            </div>
        </div>

        <form method="GET" action="Owner.php" class="filter-form">

            <div class="filter-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input
                    type="date"
                    id="tanggal_mulai"
                    name="tanggal_mulai"
                    value="<?php echo htmlspecialchars($tanggal_mulai); ?>"
                    required
                >
            </div>

            <div class="filter-group">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input
                    type="date"
                    id="tanggal_akhir"
                    name="tanggal_akhir"
                    value="<?php echo htmlspecialchars($tanggal_akhir); ?>"
                    required
                >
            </div>

            <div class="filter-group">
                <label for="nama_area">Area Parkir</label>
                <select name="nama_area" id="nama_area">
                    <option value="" <?php echo $nama_area === '' ? 'selected' : ''; ?>>
                        Semua Area
                    </option>
                    <option value="A" <?php echo $nama_area === 'A' ? 'selected' : ''; ?>>
                        Area A
                    </option>
                    <option value="B" <?php echo $nama_area === 'B' ? 'selected' : ''; ?>>
                        Area B
                    </option>
                </select>
            </div>

            <div class="filter-action">
                <button type="submit">🔍 Tampilkan Rekap</button>
            </div>

        </form>
    </div>

    <!-- RINGKASAN: TOTAL TRANSAKSI DAN TOTAL PENDAPATAN -->
    <div class="statistik">

        <div class="stat-card">
            <div class="stat-icon">🧾</div>
            <div class="stat-info">
                <p>Total Transaksi</p>
                <h2><?php echo $total_transaksi; ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info">
                <p>Total Pendapatan</p>
                <h2>
                    Rp <?php echo number_format(
                        $total_pendapatan,
                        0,
                        ',',
                        '.'
                    ); ?>
                </h2>
            </div>
        </div>

    </div>

    <div class="transaksi-card">

        <div class="transaksi-header">
            <div>
                <h2>📊 Hasil Rekap Transaksi</h2>
                <p>
                    Periode <?php echo htmlspecialchars($tanggal_mulai); ?>
                    sampai <?php echo htmlspecialchars($tanggal_akhir); ?>
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
                        <th>Nama Area</th>
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

                if ($query_rekap && mysqli_num_rows($query_rekap) > 0):
                    while ($data = mysqli_fetch_assoc($query_rekap)):
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>

                        <td>
                            <?php echo htmlspecialchars($data['Plat_nomor'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['Jenis_kendaraan'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['Warna'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['Pemilik'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['Nama_area'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['Waktu_masuk'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['Waktu_keluar'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php
                            echo ($data['Durasi_jam'] !== null)
                                ? htmlspecialchars((string)$data['Durasi_jam']) . ' jam'
                                : '-';
                            ?>
                        </td>

                        <td>
                            Rp<?php echo number_format(
                                (float)($data['Biaya_total'] ?? 0),
                                0,
                                ',',
                                '.'
                            ); ?>
                        </td>

                        <td>
                            <?php if (strtolower($data['Status'] ?? '') === 'keluar'): ?>
                                <span class="status selesai">Selesai</span>
                            <?php else: ?>
                                <span class="status masuk">
                                    <?php echo htmlspecialchars($data['Status'] ?? 'Masuk'); ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="11" class="kosong">
                            Tidak ada transaksi pada periode tersebut.
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
