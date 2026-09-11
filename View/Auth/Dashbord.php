<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Parkir</title>

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
            font-size:25px;
        }

        .header p{
            margin:5px;
            font-size:12px;
        }

        .container{
            text-align:center;
            padding:70px 20px;
        }

        .container h2{
            color:#70451f;
        }

        .garis{
            margin:20px auto 35px;
            width:230px;
            color:#8B5A2B;
        }

        .menu{
            display:flex;
            justify-content:center;
            gap:20px;
            flex-wrap:wrap;
        }

        .card{
            width:220px;
            padding:25px 15px;
            background:white;
            border:2px solid #c5ad97;
            border-radius:10px;
        }

        .icon{
            font-size:35px;
            background:#eee5dc;
            border-radius:50%;
            width:65px;
            height:65px;
            padding:12px;
            margin:auto;
        }

        .card h3{
            color:#70451f;
        }

        .card p{
            font-size:13px;
        }

        .card a,
        .logout{
            display:inline-block;
            background:#8B5A2B;
            color:white;
            text-decoration:none;
            padding:10px 30px;
            border-radius:7px;
            margin-top:10px;
        }

        .logout{
            margin-top:35px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Dashboard Parkir</h1>
        <p>Selamat datang di Aplikasi Parkir</p>
    </div>

    <div class="container">

        <h2>Dashboard Parkir</h2>

        <p>Selamat datang di Aplikasi Parkir</p>

        <div class="garis">
            ───── 🚗 ─────
        </div>

        <h2>Menu Utama</h2>

        <div class="menu">

            <!-- PARKIR MASUK -->
            <div class="card">

                <div class="icon">🚗</div>

                <h3>Parkir Masuk</h3>

                <p>
                    Catat kendaraan yang masuk
                    ke area parkir
                </p>

                <a href="Parkir/ParkirMasuk.php">
                    Masuk
                </a>

            </div>


            <!-- PARKIR KELUAR -->
            <div class="card">

                <div class="icon">🚙</div>

                <h3>Parkir Keluar</h3>

                <p>
                    Catat kendaraan yang keluar
                    dari area parkir
                </p>

                <a href="Parkir/ParkirKeluar.php">
                    Keluar
                </a>

            </div>


            <!-- DATA PARKIR -->
            <div class="card">

                <div class="icon">📋</div>

                <h3>Data Parkir</h3>

                <p>
                    Lihat daftar kendaraan
                    yang sedang parkir
                </p>

                <a href="Parkir/DataParkir.php">
                    Lihat
                </a>

            </div>

        </div>

        <a href="Auth/Login.php" class="logout">
            ⇥ Logout
        </a>

    </div>

</body>
</html>