<?= $this->render('home/header'); ?>
<section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2><?= $title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 mb-2 mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
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
            <div class="col-md-6 text-left">
                <?php if ($row->status != 'Barang Sedang di Kirim' and $row->status != 'Barang Sedang di Kemas' and $row->status != 'Selesai' and $row->status != 'Di Tolak') { ?>
                    <?php
                    if ($row->status != "Barang Telah Sampai Ke Pemesan") { ?>
                        <form action="<?php echo site_url('home/transaksidetail/' . $row->idtransaksi) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
    <label for="buktipembayaran" class="form-control">Informasi Pembayaran</label>
</div>

            <div class="informasi-pembayaran">
                <div class="rekening">
                    <div class="rekening-item">
                        <img src="https://buatlogoonline.com/wp-content/uploads/2022/10/Logo-BCA-PNG.png" alt="BCA Logo" width="100">
                        <p>Nomor Rekening: 1234567890</p>
                        <p>Atas Nama: PT. NamaPerusahaan</p>
                    </div>

                    <div class="rekening-item">
                        <img src="https://buatlogoonline.com/wp-content/uploads/2022/10/Logo-Bank-BRI.png" alt="BRI Logo" width="100">
                        <p>Nomor Rekening: 0987654321</p>
                        <p>Atas Nama: PT. NamaPerusahaan</p>
                    </div>

                    <div class="rekening-item">
                        <img src="https://brandeps.com/logo-download/B/Bank-Mandiri-logo-vector-01.svg" alt="Mandiri Logo" width="100">
                        <p>Nomor Rekening: 1122334455</p>
                        <p>Atas Nama: PT. NamaPerusahaan</p>
                    </div>
                </div>
            </div>

            <style>
                .informasi-pembayaran {
                    display: flex;
                    justify-content: space-around;
                    margin-top: 20px;
                }

                .rekening-item {
                    text-align: center;
                    margin: 0 20px;
                }

                .rekening-item img {
                    display: block;
                    margin: 0 auto 10px;
                }

                .rekening-item p {
                    margin: 5px 0;
                }
            </style>

                            <div class="form-group">
                                <label for="buktipembayaran" class="form-control">Bukti Pembayaran</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    <?php } else { ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <button data-toggle="modal" data-target="#selesaikanpesanan" class="btn btn-success btn-block">Selesaikan Pesanan</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="https://wa.me/6285172081795" target="_blank" class="btn btn-danger btn-block">Ajukan Komplain</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="selesaikanpesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Selesaikan Pesanan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo site_url('home/transaksiselesaikanpesanan/' . $row->idtransaksi) ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <p>Apakah anda yakin ingin menyelesaikan pesanan ini</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Ya, Selesaikan Pesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <img width="100%" src="<?php echo base_url('foto/' . $row->buktipembayaran) ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->render('home/footer'); ?>