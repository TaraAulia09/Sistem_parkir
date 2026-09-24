<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Parkir</title>
    <link rel="stylesheet" href="../Assets/Css/Register.css">
</head>
<body>

<div class="register-box">

    <h2>Register</h2>

    <?php
    if (isset($_GET['pesan'])) {
        echo "<p class='info'>" . htmlspecialchars($_GET['pesan']) . "</p>";
    }
    ?>

    <form action="../Controllers/RegisterController.php" method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required placeholder="Nama lengkap kamu">

        <label>Username</label>
        <input type="text" name="username" required placeholder="Buat nama pengguna">

        <label>Kata Sandi</label>
        <input type="password" name="password" required placeholder="Buat kata sandi">

        <label>Peran / Jabatan</label>
        <select name="role" required>
            <option value="">-- Pilih Peran --</option>
            <option value="Admin">Admin</option>
            <option value="Petugas">Petugas Parkir</option>
            <option value="Pemilik">Pemilik / Owner</option>
        </select>

        <button type="submit">
            Daftar Akun
        </button>

    </form>

    <p>
        Sudah punya akun?
        <a href="Login.php">Masuk di sini</a>
    </p>

</div>

</body>
</html>
