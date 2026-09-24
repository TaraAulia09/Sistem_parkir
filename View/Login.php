<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Parkir</title>
    <link rel="stylesheet" href="../Assets/Css/Login.css">
</head>

<body>

<div class="login-box">

    <h2>Login</h2>

    <?php
    if (isset($_GET['pesan'])) {
        echo "<p class='error'>" . htmlspecialchars($_GET['pesan']) . "</p>";
    }
    ?>

    <form action="../Controllers/LoginController.php" method="POST">

        <label>Username</label>

        <input
            type="text"
            name="username"
            required
            placeholder="Masukkan nama pengguna"
        >

        <label>Kata Sandi</label>

        <input
            type="password"
            name="password"
            required
            placeholder="Masukkan kata sandi"
        >

        <!-- INI TOMBOL LOGIN -->
        <button type="submit">
            Masuk
        </button>

    </form>

    <p>
        Belum punya akun?
        <a href="Register.php">
            Daftar di sini
        </a>
    </p>

</div>

</body>
</html>