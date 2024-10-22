<?= $this->extend('panel/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
                </div>
                <div class="card-body">
                    <form action="/panel/updateproduk/<?= $produk['idproduk']; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="sampulLama" value="<?= $produk['foto']; ?>">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="namaproduk" value="<?= $produk['namaproduk'] ?>" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select class="form-control" name="idkategori">
                                <option value="" disabled="disabled">Pilih Kategori</option>
                                <?php foreach ($kategori as $key => $value) : ?>

                                    <option value="<?= $value['idkategori']; ?>" <?= $produk['idkategori'] == $value['idkategori'] ? 'selected' : ''; ?>><?= $value["namakategori"]; ?></option>

                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Produk</label>
                            <input type="number" min="0" class="form-control" name="harga" value="<?= $produk['harga'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Stok Produk</label>
                            <input type="number" min="0" class="form-control" name="stok" value="<?= $produk['stok'] ?>">
                        </div>
                        <div class=" form-group">
                            <label>Deskripsi Produk</label>
                            <textarea row="10" class="form-control" name="deskripsi"><?= $produk['deskripsi'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Produk</label>
                            <div class="custom-file" style="margin-bottom: 10px;">
                                <input type="file" class="form-control" name="foto">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>