<?php

session_start();

require_once __DIR__ . '/../Config/Koneksi.php';

// Cek ID
if (!isset($_GET['id'])) {
    die("ID pengguna tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data berdasarkan ID
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM Tabel_user WHERE Id_user='$id'"
);

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data pengguna tidak ditemukan.");
}


// Jika tombol Simpan ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_lengkap = $_POST['nama_lengkap'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $role         = $_POST['role'];

    // Update data
    $update = mysqli_query(
        $koneksi,
        "UPDATE Tabel_user SET
            Nama_lengkap='$nama_lengkap',
            Username='$username',
            Password='$password',
            Role='$role'
        WHERE Id_user='$id'"
    );

    if ($update) {

        header("Location: Admin.php");
        exit;

    } else {

        die("Gagal mengubah data: " . mysqli_error($koneksi));

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Edit Pengguna</title>

    <link rel="stylesheet" href="../Assets/Css/Tambah.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>Edit Data Pengguna</h2>

        <form method="POST">

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

                <option value="Admin"
                    <?php if ($data['Role'] == 'Admin') echo 'selected'; ?>>
                    Admin
                </option>

                <option value="petugas"
                    <?php if ($data['Role'] == 'petugas') echo 'selected'; ?>>
                    Petugas
                </option>

                <option value="owner"
                    <?php if ($data['Role'] == 'owner') echo 'selected'; ?>>
                    Owner
                </option>

            </select>


            <button type="submit">
                Simpan Perubahan
            </button>

            <a href="Admin.php">
                Batal
            </a>

        </form>

    </div>

</div>

</body>

</html>