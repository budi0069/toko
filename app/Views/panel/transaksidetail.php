<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12 mb-5">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-5">
                                    <?php
                                    $pemesan = $this->db->table('pengguna')
                                        ->where('idpengguna', $row->idpengguna)
                                        ->get()
                                        ->getRow();
                                    ?>
                                    <tr>
                                        <td width="30%">Nama Pemesan</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <?= $pemesan->nama ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%">No. HP</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <?= $row->nohp ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Waktu</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <?= tanggal(date("Y-m-d", strtotime($row->waktu))) . ' ' . date("H:i", strtotime($row->waktu)); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Metode Pengiriman</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <?= $row->metodepengiriman ?>
                                        </td>
                                    </tr>
                                    <?php
                                    if ($row->metodepengiriman == 'Kurir') {;
                                        $tulisanprovinsi = explode(",", $row->provinsi);
                                        $provinsi = $tulisanprovinsi[1];
                                        $tulisankota = explode(",", $row->kota);
                                        $kota = $tulisankota[1];
                                        $tulisanlayanan = explode(",", $row->layanan);
                                        $layanan = $tulisanlayanan[1];
                                    ?>
                                        <tr>
                                            <td width="30%">Provinsi & Kota</td>
                                            <td width="1%">:</td>
                                            <td>
                                                <?= $provinsi . ', ' . $kota . ' (' . $row->kodepos . ')' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Alamat Pengiriman</td>
                                            <td width="1%">:</td>
                                            <td>
                                                <?= $row->alamat ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Kurir & Layanan</td>
                                            <td width="1%">:</td>
                                            <td>
                                                <?= $layanan ?>
                                            </td>
                                        </tr>
                                        <?php
                                        if ($row->noresi != "") { ?>
                                            <tr>
                                                <td width="30%">No. Resi</td>
                                                <td width="1%">:</td>
                                                <td>
                                                    <?= $row->noresi ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <td width="30%"><b>Status</b></td>
                                        <td width="1%">:</td>
                                        <td>
                                            <b><?= $row->status ?></b>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="cpt_no">No.</th>
                                            <th class="cpt_img">Nama Produk</th>
                                            <th class="cpt_pn">Harga</th>
                                            <th class="cpt_q">Jumlah</th>
                                            <th class="cpt_p">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                        $ambilproduk = $this->db->table('transaksidetail')->join('produk', 'transaksidetail.idproduk = produk.idproduk')->where('idtransaksi', $row->idtransaksi)->get()->getResult();
                                        foreach ($ambilproduk as $produk) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $produk->namaproduk ?>
                                                </td>
                                                <td>
                                                    <?= rupiah($produk->harga) ?>
                                                </td>
                                                <td>
                                                    <?= $produk->jumlah ?>
                                                </td>
                                                <td>
                                                    <?= rupiah($produk->subtotal) ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right">Total</td>
                                            <td>
                                                <?= rupiah($row->total) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">Ongkir</td>
                                            <td>
                                                <?= rupiah($row->ongkir) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right"><b>Grandtotal</b></td>
                                            <td>
                                                <b><?= rupiah($row->grandtotal) ?></b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if ($row->status != 'Selesai') { ?>
                            <div class="col-md-6 text-left">
                                <form action="<?php echo site_url('panel/transaksidetail/' . $row->idtransaksi) ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Status Transaksi</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Pilih Status</option>
                                            <?php if ($row->status == 'Pembayaran Menunggu Konfirmasi Toko' or $row->status == 'Barang Sedang di Kemas' or $row->status == 'Di Tolak' or $row->status == 'Barang Sudah Bisa Di Ambil di Toko' or $row->status == 'Barang Telah Di Ambil Pemesan') { ?>
                                                <option <?php if ($row->status == 'Barang Sedang di Kemas') echo 'selected'; ?> value="Barang Sedang di Kemas">Barang Sedang di Kemas</option>
                                                <?php
                                                if ($row->metodepengiriman == 'Kurir') { ?>
                                                    <option <?php if ($row->status == 'Barang Sedang di Kirim') echo 'selected'; ?> value="Barang Sedang di Kirim">Barang Sedang di Kirim</option>
                                                <?php } else { ?>
                                                    <option <?php if ($row->status == 'Barang Sudah Bisa Di Ambil di Toko') echo 'selected'; ?> value="Barang Sudah Bisa Di Ambil di Toko">Barang Sudah Bisa Di Ambil di Toko</option>
                                                    <option <?php if ($row->status == 'Barang Telah Di Ambil Pemesan') echo 'selected'; ?> value="Barang Telah Di Ambil Pemesan">Barang Telah Di Ambil Pemesan</option>
                                                <?php } ?>
                                                <option <?php if ($row->status == 'Di Tolak') echo 'selected'; ?> value="Di Tolak">Di Tolak</option>
                                            <?php } ?>
                                            <?php if ($row->status == 'Barang Sedang di Kirim' or $row->status == 'Barang Telah Sampai Ke Pemesan') { ?>
                                                <option <?php if ($row->status == 'Barang Telah Sampai Ke Pemesan') echo 'selected'; ?> value="Barang Telah Sampai Ke Pemesan">Barang Telah Sampai Ke Pemesan</option>
                                                <option <?php if ($row->status == 'Selesai') echo 'selected'; ?> value="Selesai">Selesai</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="noresi" style="display: none;">
                                        <label>No. Resi</label>
                                        <input type="number" name="noresi" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <img width="100%" src="<?php echo base_url('foto/' . $row->buktipembayaran) ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to handle status change
    function handleStatusChange() {
        var status = document.getElementById("status").value;
        var noResiDiv = document.getElementById("noresi");

        if (status === "Barang Sedang di Kirim") {
            noResiDiv.style.display = "block";
        } else {
            noResiDiv.style.display = "none";
        }
    }

    // Add event listener to status select element
    document.getElementById("status").addEventListener("change", handleStatusChange);
</script>
<?= $this->endSection(); ?>