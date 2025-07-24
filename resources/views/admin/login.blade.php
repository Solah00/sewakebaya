<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SewaKebaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Playfair Display', serif;
            background: url('/images/batik-bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .login-box h1 {
            text-align: center;
            color: #7A1F1F;
            margin-bottom: 30px;
            font-size: 36px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #7A1F1F;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #601919;
        }

        .forgot-link {
            text-align: center;
            margin-top: 10px;
            color: #7A1F1F;
            display: block;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>SewaKebaya</h1>
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn-login">Login</button>
                <a href="#" class="forgot-link">Lupa Password?</a>
            </form>
        </div>
    </div>
</body>
</html>
