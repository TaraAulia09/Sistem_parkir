<?php
include "../../Database/koneksi.php";

$data = mysqli_query($koneksi, "SELECT * FROM tb_parkir");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Parkir</title>

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family:Arial;
            background:#f5f1ed;
        }

        .header{
            background:#8B5A2B;
            color:white;
            text-align:center;
            padding:18px;
        }

        .header h1{
            margin:0;
            font-size:22px;
        }

        .box{
            width:95%;
            margin:45px auto;
            background:white;
            padding:25px;
            border:2px solid #c5ad97;
            border-radius:10px;
            overflow-x:auto;
        }

        h2{
            text-align:center;
            color:purple;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            font-size:14px;
        }

        th{
            background:#8B5A2B;
            color:white;
            padding:12px;
        }

        td{
            padding:10px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }

        tr:nth-child(even){
            background:#f5f1ed;
        }

        .back{
            display:block;
            width:150px;
            margin:25px auto 0;
            padding:10px;
            text-align:center;
            background:#8B5A2B;
            color:white;
            text-decoration:none;
            border-radius:7px;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>PARKIR</h1>
</div>

<div class="box">

    <h2>Data Parkir</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kendaraan</th>
            <th>Nomor Kendaraan</th>
            <th>Tempat</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
        </tr>

        <?php
        $no = 1;

        while($row = mysqli_fetch_assoc($data)){
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['jenis_kendaraan']); ?></td>
            <td><?= htmlspecialchars($row['nomor_kendaraan']); ?></td>
            <td><?= htmlspecialchars($row['tempat_parkir']); ?></td>
            <td><?= htmlspecialchars($row['tanggal']); ?></td>
            <td><?= htmlspecialchars($row['jam_masuk']); ?></td>
        </tr>

        <?php } ?>

    </table>

    <a href="Dashbord.php" class="back">
        Kembali ke Dashboard
    </a>

</div>

</body>
</html>