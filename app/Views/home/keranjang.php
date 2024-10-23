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
                                    <a href="<?php echo base_url('home/keranjanghapus/' . $keranjang['rowid']); ?>" class="btn btn-danger">Hapus</a>
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
                        <p class="text-white">Total : <span id="totalpembayaran"><?php echo rupiah($total); ?></span></p>
                        <p class="text-white d-none" id="pdiskon">Diskon : <span id="diskonpersen">%</p>
                    </div>
                    <div class="coupon-section">
                        <h5 class="text-white">Coupons</h5>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter coupon code" aria-label="Coupon code" id="couponinput" />
                            <button class="btn btn-primary" onclick="kupon()" type="button">Apply</button>
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
<script>
    let datakupon = <?= json_encode($kupon) ?>;
    // console.log(datakupon);
    function kupon() {
        let couponValue = document.getElementById('couponinput').value
        if (couponValue == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kode Kupon Tidak Valid'
            })
        } else {
            let kupon = datakupon.filter(kupon => kupon.code == couponValue)
            // console.log(kupon)
            if (kupon.length > 0) {
                Swal.fire({
                    icon: 'success',
                    title: 'Selamat',
                    text: 'Kupon Valid Njir'
                })
                let discount_percent = kupon[0].discount_percent
                discount_percent = parseInt(discount_percent)
                // console.log(discount_percent)
                let totalpembayaran = document.getElementById('totalpembayaran').innerText
                let pdiskon = document.getElementById('pdiskon')
                pdiskon.classList.remove('d-none')
                let diskonpersen = document.getElementById('diskonpersen')
                diskonpersen.innerText = discount_percent+'%'
                totalpembayaran = totalpembayaran.slice(0, -3)
                totalpembayaran = totalpembayaran.replace(".", "")
                totalpembayaran = totalpembayaran.replace("Rp ", "")
                totalpembayaran = parseInt(totalpembayaran)
                // console.log(totalpembayaran)
                totalpembayaran = totalpembayaran - (totalpembayaran * (discount_percent / 100))
                totalpembayaran = totalpembayaran.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                document.getElementById('totalpembayaran').innerText = 'Rp ' + totalpembayaran + ',00'
                // console.log(totalpembayaran)
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Kupon Tidak Valid'
                })
            }
        }
    }
</script>

<?= $this->render('home/footer'); ?>