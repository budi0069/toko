<?= $this->render('home/header'); ?>
<?php
$id = session('idpengguna');
?>
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
                    <table class="table table-bordered table-hover custom-table">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Ulasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $ambilproduk = $this->db->table('transaksidetail')->join('produk', 'transaksidetail.idproduk = produk.idproduk')->where('idtransaksi', $row->idtransaksi)->get()->getResult();
                            foreach ($ambilproduk as $produk) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $produk->namaproduk ?></td>
                                    <td><?= rupiah($produk->harga) ?></td>
                                    <td><?= $produk->jumlah ?></td>
                                    <td><?= rupiah($produk->subtotal) ?></td>
                                    <td>
                                        <?php if ($produk->statusulasan == "Sudah") { ?>
                                            <a data-toggle="modal" data-target="#editulasan<?= $no ?>" class="btn btn-warning text-white">Edit Ulasan</a>
                                        <?php } else { ?>
                                            <a data-toggle="modal" data-target="#exampleModal<?= $no ?>" class="btn btn-success text-white">Berikan Ulasan Produk Ini</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Modal untuk Ulasan -->
                    <?php
                    $no = 1;
                    foreach ($ambilproduk as $produk) {
                    ?>
                        <div class="modal fade" id="exampleModal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $no ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel<?= $no ?>">Berikan Ulasan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="<?= base_url('home/transaksiulasan/' . $row->idtransaksi) ?>" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="idproduk" value="<?= $produk->idproduk ?>">
                                                <input type="hidden" name="idpengguna" value="<?= $id ?>">
                                                <input type="hidden" name="idtransaksi" value="<?= $row->idtransaksi ?>">
                                                <input type="hidden" name="idtransaksidetail" value="<?= $produk->idtransaksidetail ?>">
                                                <label for="kritik">Rating</label> <br>
                                                <div class="bintang">
                                                    <input type="radio" id="star5<?= $no ?>" name="bintang" value="5" required />
                                                    <label for="star5<?= $no ?>" title="5 Bintang">5 Bintang</label>
                                                    <input type="radio" id="star4<?= $no ?>" name="bintang" value="4" required />
                                                    <label for="star4<?= $no ?>" title="4 Bintang">4 Bintang</label>
                                                    <input type="radio" id="star3<?= $no ?>" name="bintang" value="3" required />
                                                    <label for="star3<?= $no ?>" title="3 Bintang">3 Bintang</label>
                                                    <input type="radio" id="star2<?= $no ?>" name="bintang" value="2" required />
                                                    <label for="star2<?= $no ?>" title="2 Bintang">2 Bintang</label>
                                                    <input type="radio" id="star1<?= $no ?>" name="bintang" value="1" required />
                                                    <label for="star1<?= $no ?>" title="1 Bintang">1 Bintang</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="ulasan">Ulasan</label>
                                                <textarea class="form-control" name="ulasan" rows="3" required></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" class="form-control" name="foto" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Tampilkan Nama Ulasan</label>
                                                <select name="tampilannama" class="form-control" required>
                                                    <option value="Tampilkan Nama">Tampilkan Nama</option>
                                                    <option value="Anonim">Anonim</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php $no++; } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->render('home/footer'); ?>

<!-- Custom CSS -->
<style>
    /* Breadcrumb Styling */
    .breadcrumb_part {
        background-color: #f1f3f5;
        padding: 15px 0;
    }
    
    .breadcrumb_iner h2 {
        color: #6c757d;
        font-weight: 600;
    }

    /* Table Styling */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-table th, .custom-table td {
        padding: 12px;
        font-size: 14px;
        border: 1px solid #e9ecef;
        vertical-align: middle;
        text-align: left;
    }

    .custom-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f3f5;
    }

    .btn {
        padding: 6px 12px;
        font-size: 13px;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .custom-table th, .custom-table td {
            font-size: 12px;
            padding: 8px;
        }

        .btn {
            padding: 4px 8px;
        }
    }
</style>
