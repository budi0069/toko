<?= $this->render('home/header'); ?>
<section class="breadcrumb_part" style="background-color: #f1f3f5; padding: 20px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2 style="color: #6c757d; font-weight: 600;"><?= $title ?></h2>
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
                    <table class="table table-hover table-borderless custom-table">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Daftar Pembelian</th>
                                <th>Metode Pengiriman</th>
                                <th>Total</th>
                                <th>Ongkir</th>
                                <th>Grandtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($riwayat as $row) { ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php
                                        $ambilproduk = $this->db->table('transaksidetail')->where('idtransaksi', $row->idtransaksi)->join('produk', 'transaksidetail.idproduk = produk.idproduk')->get()->getResult();
                                        foreach ($ambilproduk as $produk) {
                                            echo '- ' . $produk->namaproduk . ' x ' . $produk->jumlah . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row->metodepengiriman ?></td>
                                    <td><?= rupiah($row->total) ?></td>
                                    <td><?= rupiah($row->ongkir) ?></td>
                                    <td><?= rupiah($row->grandtotal) ?></td>
                                    <td>
                                        <?php
                                        if ($row->status == "Belum Mengupload Bukti Pembayaran") {
                                        ?>
                                            <a class="btn btn-secondary btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Belum Mengupload Bukti Pembayaran</a>
                                            <a class="btn btn-danger btn-sm m-1" href="<?= base_url('home/transaksibatal/' . $row->idtransaksi) ?>">Batal</a>
                                        <?php } elseif ($row->status == "Pembayaran Menunggu Konfirmasi Toko") { ?>
                                            <a class="btn btn-info btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Pembayaran Menunggu Konfirmasi Toko</a>
                                        <?php } elseif ($row->status == "Barang Sedang di Kemas") { ?>
                                            <a class="btn btn-info btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Barang Sedang di Kemas</a>
                                        <?php } elseif ($row->status == "Barang Sedang di Kirim") { ?>
                                            <a class="btn btn-info btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Barang Sedang di Kirim</a>
                                        <?php } elseif ($row->status == "Barang Telah Sampai Ke Pemesan") { ?>
                                            <a class="btn btn-primary btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Barang Telah Sampai Ke Pemesan</a>
                                        <?php } elseif ($row->status == "Barang Sudah Bisa Di Ambil di Toko") { ?>
                                            <a class="btn btn-info btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Barang Sudah Bisa Di Ambil di Toko</a>
                                        <?php } elseif ($row->status == "Barang Telah Di Ambil Pemesan") { ?>
                                            <a class="btn btn-success btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Barang Telah Di Ambil Pemesan</a>
                                        <?php } elseif ($row->status == "Selesai") { ?>
                                            <a class="btn btn-success btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Selesai</a>
                                            <a class="btn btn-primary btn-sm m-1" href="<?= base_url('home/transaksiulasan/' . $row->idtransaksi) ?>">Berikan Ulasan</a>
                                        <?php } elseif ($row->status == "Di Tolak") { ?>
                                            <a class="btn btn-warning btn-sm m-1" href="<?= base_url('home/transaksidetail/' . $row->idtransaksi) ?>">Di Tolak</a>
                                            <a class="btn btn-danger btn-sm m-1" href="<?= base_url('home/transaksibatal/' . $row->idtransaksi) ?>">Batal</a>
                                        <?php } ?>
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
</section>
<?= $this->render('home/footer'); ?>

<style>
    /* Table Styles */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-table thead {
        background-color: #f8f9fa;
    }

    .custom-table th {
        padding: 12px;
        font-weight: 600;
        font-size: 14px;
        text-align: left;
        border-bottom: 2px solid #e9ecef;
    }

    .custom-table td {
        padding: 12px;
        font-size: 14px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    /* Row Hover Effect */
    .custom-table tbody tr:hover {
        background-color: #f1f3f5;
    }

    /* Button Styles */
    .btn {
        padding: 5px 10px;
        font-size: 13px;
    }

    .btn-sm {
        font-size: 12px;
    }

    /* Text alignment for currency columns */
    .custom-table td:nth-child(4),
    .custom-table td:nth-child(5),
    .custom-table td:nth-child(6) {
        text-align: right;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .custom-table {
            font-size: 12px;
        }

        .btn {
            padding: 4px 8px;
        }
    }
</style>
