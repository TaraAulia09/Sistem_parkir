<?php  
  
session_start();  
  
require_once __DIR__ . '/../Config/Koneksi.php';  
  
?>  <!DOCTYPE html>  
<html>  
  
<head>  
    <meta charset="UTF-8">  
  
    <title>Tambah Pengguna</title>  <link rel="stylesheet" href="../Assets/Css/Tambah.css?v=1">

</head>  
  
  <body>  
    
  <div class="container">  
    <div class="card">  

    <h2>Tambah Pengguna</h2>  

    <form action="../Controllers/Tambah_PenggunaController.php" method="POST">  

        <label>Nama Lengkap</label>  

        <input  
            type="text"  
            name="nama_lengkap"  
            placeholder="Masukkan nama lengkap"  
            required>  

        <label>Username</label>  

        <input  
            type="text"  
            name="username"  
            placeholder="Masukkan username"  
            required  >  

        <label>Password</label>  

        <input  
            type="password"  
            name="password"  
            placeholder="Masukkan password"  
            required>  

        <label>Role</label>  

        <select name="role" required>  

            <option value="">-- Pilih Role --</option>  

            <option value="Admin">  
                Admin  
            </option>  

            <option value="Petugas">  
                Petugas  
            </option>  

            <option value="Owner">  
                Owner  
            </option>  

        </select>  


        <div class="form-buttons">

                <button type="submit">
                    Simpan
                </button>

                <a href="Admin.php" class="btn-batal">
                    Batal
                </a>

    </form>  

</div>

</div>  
    
</body>  
  
</html>