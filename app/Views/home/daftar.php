<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 57vh;
            margin: 10%;
            background-color: #f7f8fa;
        }
        .container {
            display: flex;
            width: 90%; /* Adjusted width to make it smaller */
            max-width: 80%; /* Set max width to ensure responsiveness */
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .left {
            width: 59%; /* Adjusted the width of the image side */
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .left img {
            width: 2000px; /* Ensure the image fits within its container */
            height: auto;
        }
        .right {
            width: 60%; /* Adjusted the form width */
            padding: 30px; /* Less padding to fit smaller form */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right h2 {
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px; /* Adjusted margin to make form compact */
        }
        .form-group label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 8px; /* Smaller padding for inputs */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-primary:hover {
            background-color: #444;
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
        <img src="<?= base_url('foto/jordan.png') ?>" alt="Illustration">
    </div>
    <div class="right">
        <h2><?= $title ?></h2>
        <form method="post" action="<?= base_url('home/daftar') ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="number" class="form-control" name="nohp">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
            <div class="login-link">
                <p>Sudah punya akun? <a href="<?= base_url('home/login/') ?>">Login</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>
