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
                    <a href="/panel/tambahproduk" class="btn btn-primary my-3">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Foto Produk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($produk as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $p['namaproduk']; ?></td>
                                        <td><?= $p['namakategori']; ?></td>
                                        <td>
                                            <?= rupiah($p['harga']); ?>
                                        </td>
                                        <td>
                                            <?= $p['stok'] ?>
                                        </td>
                                        <td><img src="/foto/<?= $p['foto']; ?>" alt="" width="150px"></td>
                                        <td>
                                            <a href="/panel/ubahproduk/<?= $p['idproduk'] ?>" class="btn btn-warning m-1">Edit</a>
                                            <a href="/panel/hapusproduk/<?= $p['idproduk'] ?>" class="btn btn-danger m-1">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>