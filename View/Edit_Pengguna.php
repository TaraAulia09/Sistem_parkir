<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: Login.php");
    exit;
}

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: Login.php");
    exit;
}

require_once __DIR__ . '/../Config/Koneksi.php';
require_once __DIR__ . '/../Controllers/C_Pengguna.php';

$controller = new C_Pengguna($koneksi);

// Periksa ID dari URL
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: Pengguna.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data melalui Controller
$data = $controller->getPenggunaById($id);

if (!$data) {
    die("Data pengguna tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Pengguna</title>

    <link rel="stylesheet" href="../Assets/Css/Tambah.css?v=5">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Edit Data Pengguna</h2>

        <form action="../Controllers/Edit_PenggunaController.php" method="POST">
    <input type="hidden" name="id" value="<?php echo (int) $data['Id_user']; ?>">

            <label>Nama Lengkap</label>

            <input
                type="text"
                name="nama_lengkap"
                value="<?php echo htmlspecialchars($data['Nama_lengkap']); ?>"
                required
            >


            <label>Username</label>

            <input
                type="text"
                name="username"
                value="<?php echo htmlspecialchars($data['Username']); ?>"
                required
            >


            <label>Password</label>

            <input
                type="text"
                name="password"
                value="<?php echo htmlspecialchars($data['Password']); ?>"
                required
            >


            <label>Role</label>

            <select name="role" required>
           <option value="">-- Pilih Role --</option>

            <option value="admin"
              <?php if (strtolower($data['Role']) == 'admin') echo 'selected'; ?>>
                 Admin
               </option>

              <option value="petugas"
             <?php if (strtolower($data['Role']) == 'petugas') echo 'selected'; ?>>
              Petugas
              </option>

              <option value="owner"
             <?php if (strtolower($data['Role']) == 'owner') echo 'selected'; ?>>
               Owner
              </option>
               </select>

            <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a
                    href="Pengguna.php"
                    class="btn-batal"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>