<!DOCTYPE html>
<html>
<head>
    <title>Tambah Parkir</title>

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family:Arial;
            background:#f5f1ed;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
        }

        .box{
            width:100%;
            max-width:600px;
            background:white;
            padding:45px;
            border:2px solid #8B5A2B;
            border-radius:15px;
        }

        h2{
            text-align:center;
            color:purple;
            font-size:30px;
            margin-bottom:30px;
        }

        label{
            display:block;
            margin-top:15px;
            font-weight:bold;
        }

        input, select{
            width:100%;
            padding:14px;
            margin-top:7px;
            border:2px solid #8B5A2B;
            border-radius:10px;
            background:#fcecec;
            font-size:16px;
        }

        button{
            width:100%;
            padding:15px;
            margin-top:25px;
            background:#8B5A2B;
            color:white;
            border:none;
            border-radius:10px;
            font-size:18px;
        }

        .kembali{
            display:block;
            text-align:center;
            margin-top:20px;
            color:blue;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Tambah Data Parkir</h2>

    <form action="#" method="POST">

        <label>Nama</label>
        <input type="text" name="nama"
               placeholder="Masukkan nama" required>

        <label>Nomor Kendaraan</label>
        <input type="text" name="nomor_kendaraan"
               placeholder="Contoh: B 1234 ABC" required>

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="">-- Pilih Kendaraan --</option>
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
        </select>

        <label>Tempat Parkir</label>
        <select name="area" required>
            <option value="">-- Pilih Area --</option>
            <option value="Area A">Area A</option>
            <option value="Area B">Area B</option>
            <option value="Area C">Area C</option>
        </select>

        <label>Tanggal</label>
        <input type="date" name="tanggal" required>

        <label>Jam Masuk</label>
        <input type="time" name="jam_masuk" required>
        
         <label>Jam Keluar</label>
        <input type="time" name="jam_keluar" required>

        <button type="submit">
            Simpan Data Parkir
        </button>

    </form>

    <a href="DataParkir.php" class="kembali">
        Kembali ke Data Parkir
    </a>

</div>

</body>
</html>