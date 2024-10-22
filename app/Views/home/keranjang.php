<?= $this->render('home/header'); ?>



<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-2 mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="cpt_no">No.</th>
                                <th class="cpt_img">Foto Produk</th>
                                <th class="cpt_pn">Nama</th>
                                <th class="cpt_q">Jumlah</th>
                                <th class="cpt_p">Harga</th>
                                <th class="cpt_t">Total</th>
                                <th class="cpt_r">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php
                            $total = 0;
                            foreach ($cart->contents() as $keranjang) {
                                $idproduk = $keranjang['id'];
                                $row = $this->db->table('produk')->join('kategori', 'produk.idkategori = kategori.idkategori')->where('idproduk', $idproduk)->get()->getRow();
                            ?>
                            <tr>
                                <td><span class="cp_no"><?php echo $i; ?></span></td>
                                <td><a href="<?php echo base_url('foto/' . $row->foto); ?>"><img style="width: 80px;" src="<?php echo base_url('foto/' . $row->foto); ?>" alt="" /></a></td>
                                <input type="hidden" name="cart[<?php echo $keranjang['id']; ?>][id]" value="<?php echo $keranjang['id']; ?>" />
                                <input type="hidden" name="cart[<?php echo $keranjang['id']; ?>][rowid]" value="<?php echo $keranjang['rowid']; ?>" />
                                <input type="hidden" name="cart[<?php echo $keranjang['id']; ?>][name]" value="<?php echo $keranjang['name']; ?>" />
                                <input type="hidden" name="cart[<?php echo $keranjang['id']; ?>][price]" value="<?php echo $keranjang['price']; ?>" />
                                <input type="hidden" name="cart[<?php echo $keranjang['id']; ?>][qty]" value="<?php echo $keranjang['qty']; ?>" />
                                <td>
                                    <p class="cp_price"><?php echo $keranjang['name']; ?></p>
                                </td>
                                <td>
                                <p class="cp_price"><?php echo $keranjang['qty']; ?></p>
                                </td>
                                <td>
                                    <p class="cp_price"><?php echo rupiah($keranjang['price']); ?></p>
                                </td>
                                <td>
                                    <p class="cpp_total"><?php echo rupiah($keranjang['subtotal']); ?></p>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('home/keranjanghapus/' . $keranjang['rowid']); ?>" class="genric-btn danger circle">Hapus</a>
                                </td>
                            </tr>
                            <?php
                                $total += $keranjang['subtotal'];
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 mb-2 mt-5">
                <div class="summary-section">
                    <h4 class="text-white">Detail Pembayaran</h4>
                    <div class="summary-item">
                        <p class="text-white">Total : <span><?php echo rupiah($total); ?></span></p>
                    </div>
                    <div class="coupon-section">
                        <h5 class="text-white">Coupons</h5>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter coupon code" aria-label="Coupon code" />
                            <button class="btn btn-primary" type="button">Apply</button>
                        </div>
                    </div>
                    <div class="cart-action">
                        <a href="<?php echo base_url('home/produkdaftar'); ?>" class="genric-btn primary circle">Lanjut Belanja</a>
                        <a href="<?php echo base_url('home/checkout'); ?>" class="genric-btn success circle">Bayar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Style untuk tabel keranjang */
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table th {
        background-color: #f7f7f7;
        font-weight: bold;
    }
    .cp_no, .cp_price, .cpp_total {
        font-size: 14px;
    }
    .quantity-input {
        width: 70px;
    }
    .summary-section {
        background-color: #333;
        padding: 20px;
        border-radius: 5px;
        color: white;
    }
    .summary-item, .coupon-section {
        margin-bottom: 15px;
    }
    .coupon-section h5 {
        margin-bottom: 10px;
    }
    .cart-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }
    .genric-btn {
        width: 48%;
        text-align: center;
    }
</style>

<?= $this->render('home/footer'); ?>
