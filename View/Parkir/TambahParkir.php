<!DOCTYPE html>
<html>
<head>
    <title>Parkir Masuk</title>

    <style>
        body{
            margin:0;
            font-family:Arial;
            background:#f5f1ed;
        }

        .header{
            background:#8B5A2B;
            color:white;
            padding:15px;
            text-align:center;
        }

        .header h1{
            margin:0;
            font-size:22px;
        }

        .box{
            width:500px;
            max-width:90%;
            margin:40px auto;
            background:white;
            padding:35px;
            border:2px solid #8B5A2B;
            border-radius:12px;
            box-sizing:border-box;
        }

        h2{
            text-align:center;
            color:purple;
            margin-bottom:30px;
        }

        label{
            display:block;
            text-align:left;
            margin-top:15px;
            font-weight:bold;
        }

        input, select{
            width:100%;
            padding:13px;
            margin-top:7px;
            border:2px solid #8B5A2B;
            border-radius:10px;
            box-sizing:border-box;
            font-size:15px;
        }

        button{
            width:100%;
            padding:13px;
            margin-top:25px;
            background:#8B5A2B;
            color:white;
            border:none;
            border-radius:10px;
            font-size:16px;
        }

        .back{
            display:block;
            text-align:center;
            margin-top:20px;
            color:blue;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>PARKIR</h1>
</div>

<div class="box">

    <h2>Parkir Masuk</h2>

    <!-- Setelah disimpan, masuk ke ParkirKeluar.php -->
    <form action="ParkirKeluar.php" method="POST">

        <label>Nama</label>
        <input
            type="text"
            name="nama"
            placeholder="Masukkan nama"
            required
        >

        <label>Jenis Kendaraan</label>
        <select name="kendaraan" required>
            <option value="">-- Pilih kendaraan --</option>
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
        </select>

        <label>Nomor Kendaraan</label>
        <input
            type="text"
            name="nomor"
            placeholder="Contoh: B 1234 ABC"
            required
        >

        <label>Tempat Parkir</label>
        <select name="tempat" required>
            <option value="">-- Pilih tempat --</option>
            <option value="Area A">Area A</option>
            <option value="Area B">Area B</option>
            <option value="Area C">Area C</option>
        </select>

        <label>Tanggal</label>
        <input
            type="date"
            name="tanggal"
            required
        >

        <label>Jam Masuk</label>
        <input
            type="time"
            name="jam_masuk"
            required
        >

        <button type="submit">
            Simpan Data Parkir
        </button>

    </form>

    <a href="../Dashboard.php" class="back">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>