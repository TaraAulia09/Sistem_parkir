<?php

require_once __DIR__ . '/../Config/Koneksi.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM Tabel_user 
         WHERE username='$username' 
         AND password='$password'"
    );

    if (!$query) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $data['Id_user'];
        $_SESSION['username'] = $data['Username'];
        $_SESSION['role'] = $data['Role'];

        $role = strtolower($data['Role']);

        if ($role == 'admin') {

            header("Location: ../View/Admin.php");
            exit;

        } elseif ($role == 'petugas' || $role == 'petugas') {

            header("Location: ../View/Petugas.php");
            exit;

        } elseif ($role == 'owner') {

            header("Location: ../View/Owner.php");
            exit;

        } else {

            echo "Role tidak dikenali: " . $data['Role'];

        }

    } else {

        echo "Username atau password salah";

    }
}
?>