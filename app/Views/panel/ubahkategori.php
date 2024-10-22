<?= $this->extend('panel/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori</h6>
                </div>
                <div class="card-body">
                    <form action="/panel/updatekategori/<?= $kategori['idkategori']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="namakategori" value="<?= $kategori['namakategori']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="tambah">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>