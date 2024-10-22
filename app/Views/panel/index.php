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
                    <img src="<?= base_url('foto/welcome.jpg') ?>" width="100%" class="pt-5 pb-3">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Jumlah Akun Pembeli</span>
                    <h3 class="card-title mb-2"><?= $jumlahakunpembeli ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Jumlah Jenis Produk</span>
                    <h3 class="card-title mb-2"><?= $jumlahjenisproduk ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>