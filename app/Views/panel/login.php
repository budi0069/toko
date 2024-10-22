<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/panel/') ?>/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('foto/logo.webp') ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/css/demo.css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/css/pages/page-auth.css" />
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url('assets/panel/') ?>/assets/js/config.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2">Login Akun</h4>
                        <p class="mb-1"> Internal Visual Celullar</p>
                        <form method="post" action="<?= base_url('panel/login') ?>" class="pt-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                            </div>
                            <div class="mt-3">
                                <center>
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Login</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/js/menu.js"></script>
    <script src="<?= base_url('assets/panel/') ?>/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(function() {
            <?php if (session()->has("success")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '<?= session("success") ?>'
                })
            <?php } ?>
        });
        $(function() {
            <?php if (session()->has("error")) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session("error") ?>'
                })
            <?php } ?>
        });
    </script>
</body>

</html>