<?= $this->render('home/header'); ?>
<section class="breadcrumb_part" style="background-color: #989da1; padding: 20px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2 style="color: #ffff; font-weight: 600;"><?= $title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="single_product_list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single_product_iner">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-10 my-auto">
                            <form method="post" action="<?= base_url('home/profil') ?>" class="pt-5">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $row->nama ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="number" class="form-control" name="nohp" value="<?= $row->nohp ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="3"><?= $row->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $row->email ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password">
                                    <span class="text-danger">Kosongkan jika tidak ingin mengganti password</span>
                                </div>
                                <div class="mt-3">
                                    <center>
                                        <button class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" type="submit">Edit Profil</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->render('home/footer'); ?>