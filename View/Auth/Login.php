<!DOCTYPE html>
<html>
<head>
    <title>Login Parkir</title>

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family:Arial;
            background:#f5f1ed;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:25px;
        }

        .login-box{
            width:100%;
            max-width:650px;
            background:white;
            padding:60px 55px;
            border:3px solid #8B5A2B;
            text-align:center;
            border-radius:18px;
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

        .forgot{
            display:block;
            text-align:right;
            margin-top:5px;
            font-size:16px;
        }

        button{
            width:80%;
            padding:18px;
            background:#8B5A2B;
            color:white;
            border:none;
            border-radius:12px;
            font-size:20px;
            margin-top:25px;
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
            margin-top:35px ;
        }
    </style>
</head>

<body>

    <div class="login-box">

        <h2>Login</h2>

        <form action="Register.php" method="POST">

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <a href="#" class="forgot">
                Forgot Password?
            </a>

            <button type="submit">
                Login
            </button>

        </form>

        <p>
            Don't have an account?
            <a href="Register.php">Register</a>
        </p>

    </div>

</body>
</html>