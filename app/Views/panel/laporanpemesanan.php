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
                    <form method="post" accept="<?= base_url('admin/laporanpembelianbahanbakudaftar') ?>">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="tanggalawal" value="<?= $tanggalawal ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="tanggalakhir" value="<?= $tanggalakhir ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-white" style="margin-top:30px">Cari</button>
                                    <a href="<?= base_url('panel/laporanpemesanancetak/' . $tanggalawal . '/' . $tanggalakhir) ?>" target="_blank" class="btn btn-success" style="margin-top:30px">Download Laporan</a>

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pemesan</th>
                                    <th>Tanggal</th>
                                    <th>Daftar Pembelian</th>
                                    <th>Grandtotal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($riwayat as $row) {
                                    $pemesan = $this->db->table('pengguna')
                                        ->where('idpengguna', $row->idpengguna)
                                        ->get()
                                        ->getRow();
                                ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?= $pemesan->nama ?>
                                        </td>
                                        <td>
                                            <?= tanggal(date("Y-m-d", strtotime($row->waktu))) . ' ' . date("H:i", strtotime($row->waktu)); ?>
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
                                            <?= $row->status ?>
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