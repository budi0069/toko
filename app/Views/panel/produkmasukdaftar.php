<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header bg-dark py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-white"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('panel/produkmasuktambah') ?>" class="btn btn-primary my-3">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <td>Supplier</td>
                                    <td>Tanggal</td>
                                    <th>Produk</th>
                                    <th>Grandtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($produkmasuk as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->supplier; ?></td>
                                        <td><?= tanggal($row->tanggal); ?></td>
                                        <td>
                                            <?php
                                            $ambilproduk = $this->db->table('produkmasuk')->join('produk', 'produkmasuk.idproduk = produk.idproduk')->get()->getResult();
                                            foreach ($ambilproduk as $produk) {
                                                echo '- ' . $produk->namaproduk . ' x ' . $produk->jumlah . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td><?= rupiah($row->grandtotal); ?></td>
                                        <td>
                                            <a href="<?= base_url('panel/produkmasukedit/' . $row->kode) ?>" class="btn btn-warning m-1">Edit</a>
                                            <a href="<?= base_url('panel/produkmasukhapus/' . $row->kode) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>