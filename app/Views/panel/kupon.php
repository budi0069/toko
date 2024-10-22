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
                    <h3 class="text-center mt-4">Halaman Kupon </h3>
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
                                    <td><?= $k['discount_persent'] ?></td>
                                    <td><?= $k['valid_until'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger">Hapus</a>
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
<?= $this->endSection(); ?>
