<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="icon" href="<?= base_url('foto/logo.webp') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f8fa;
        }
        .container {
            display: flex;
            width: 70%;
            height: 80%;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .left {
            width: 50%;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .left img {
            width: 100%;
            height: auto;
        }
        .right {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 50px;
            border-radius: 10px;
        }
        .btn-primary {
            
            margin-top: 40px;
            color: #fff;
            background-color: #333;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #444;
        }
        .text-center {
            text-align: center;
            margin-top: 20px;
        }
        .text-center a {
            color: #007bff;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>

<div class="container">
    <div class="left">
        <img src="<?= base_url('foto/jordan.png') ?>" alt="Login Illustration">
    </div>
    <div class="right">
        <h2><?= $title ?></h2>
        <form method="post" action="<?= base_url('home/login') ?>">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="login-link">
                <p>Belum punya akun? <a href="<?= base_url('home/daftar/') ?>">Daftar disini</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>
