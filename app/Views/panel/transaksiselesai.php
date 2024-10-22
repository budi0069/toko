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
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Daftar Pembelian</th>
                                    <th>Grandtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($riwayat as $row) { ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?php
                                            $ambilproduk = $this->db->table('transaksidetail')->where('idtransaksi', $row->idtransaksi)->join('produk', 'transaksidetail.idproduk = produk.idproduk')->get()->getResult();
                                            foreach ($ambilproduk as $produk) {
                                                echo '- ' . $produk->namaproduk . ' x ' . $produk->jumlah . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= rupiah($row->grandtotal) ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success m-1" href="<?= base_url('panel/transaksidetail/' . $row->idtransaksi) ?>">Selesai</a>
                                            <a class="btn btn-danger m-1 bdel" href="<?= base_url('panel/transaksiselesaihapus/' . $row->idtransaksi) ?>">Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>