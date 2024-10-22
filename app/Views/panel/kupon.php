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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
