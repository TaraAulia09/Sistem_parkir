<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Parkir</title>

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

            padding:20px;
        }

        .register-box{
            width:100%;
            max-width:650px;
            background:white;
            padding:60px 50px;
            border:3px solid #8B5A2B;
            border-radius:18px;
            text-align:center;
        }

        h2{
            color:purple;
            font-size:38px;
            margin:0 0 40px;
        }

        input{
            width:100%;
            padding:18px;
            margin:12px 0;
            border:3px solid #8B5A2B;
            border-radius:12px;
            background:#fcecec;
            font-size:18px;
        }

        input:focus{
            outline:none;
            border-color:purple;
        }

        button{
            width:80%;
            padding:18px;
            margin-top:25px;
            background:#8B5A2B;
            color:white;
            border:none;
            border-radius:12px;
            font-size:20px;
            cursor:pointer;
        }

        button:hover{
            background:#6b3f1f;
        }

        a{
            text-decoration:none;
            color:blue;
        }

        p{
            font-size:17px;
            margin-top:35px;
        }
    </style>
</head>

<body>

    <div class="register-box">

        <h2>Registrasi</h2>

        <input
            type="text"
            name="nama"
            placeholder="Nama"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="E-mail"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Kata sandi"
            required
        >

          <form action="Dashboard.php" method="POST">
            
            <button type="button" onclick="window.location.href='Dashbord.php'">
             Buat Akun
           </button>

        <p>
            Sudah memiliki akun?
            <a href="Login.php">Masuk</a>
              
        </p>

    </div>

</body>
</html>
