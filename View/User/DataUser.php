<?php
include "../../Database/Koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>

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
            padding:15px;
            text-align:center;
            font-weight:bold;
        }

        .logout{
            float:right;
            color:white;
            text-decoration:none;
            font-size:13px;
        }

        .box{
            width:95%;
            margin:25px auto;
            background:white;
            padding:25px;
            border:2px solid #ddd;
            border-radius:6px;
        }

        h2{
            text-align:center;
            color:purple;
            font-size:20px;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#8B5A2B;
            color:white;
            padding:10px;
            font-size:13px;
        }

        td{
            padding:9px;
            text-align:center;
            border:1px solid #ddd;
            font-size:13px;
        }

        tr:nth-child(even){
            background:#fcecec;
        }

        .kembali{
            display:block;
            width:150px;
            margin:20px auto 0;
            padding:10px;
            text-align:center;
            background:#8B5A2B;
            color:white;
            text-decoration:none;
            border-radius:5px;
            font-size:12px;
        }
    </style>
</head>

<body>

<div class="header">
    PARKIR

    <a href="../../Login.php" class="logout">
        Logout
    </a>
</div>

<div class="box">

    <h2>Data User</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
        </tr>

        <?php
        $no = 1;

        while($data = mysqli_fetch_assoc($query)){
        ?>

        <tr>
            <td><?php echo $no++; ?></td>

            <td>
                <?php echo htmlspecialchars($data['nama']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($data['username']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($data['role']); ?>
            </td>
        </tr>

        <?php } ?>

    </table>

    <a href="../Dashboard.php" class="kembali">
        Kembali ke Dashboard
    </a>

</div>

</body>
</html>