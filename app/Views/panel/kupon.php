<?= $this->extend('panel/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header bg-dark py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-white"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <h3 class="text-center mt-4">Halaman Kupon</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Tambah Kupon</h6>
                            <form action="/panel/insert_kupon" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label>Kode Kupon</label>
                                    <input type="text" class="form-control" name="code" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label>Valid Until</label>
                                    <input type="date" class="form-control" name="valid_until" required>
                                </div>
                                <div class="form-group">
                                    <label>Discount Percent</label>
                                    <input type="text" class="form-control" name="discount_percent">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <h6>Data Kupon</h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">no</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Diskon</th>
                                        <th scope="col">Diskon Berakhir</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kupon as $k) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $k['code'] ?></td>
                                            <td><?= $k['discount_percent'] ?></td>
                                            <td><?= $k['valid_until'] ?></td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="/panel/delete_kupon/<?= $k['id_diskon'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>