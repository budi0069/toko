<?= $this->render('home/header'); ?>

<section class="mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 mb-2 mt-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; $total = 0; ?>
                            <?php foreach ($cart->contents() as $keranjang): ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $keranjang['name']; ?></td>
                                    <td><?= $keranjang['qty']; ?></td>
                                    <td><?= rupiah($keranjang['price']); ?></td>
                                    <td><?= rupiah($keranjang['subtotal']); ?></td>
                                </tr>
                                <?php $total += $keranjang['subtotal']; $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">Total</td>
                                <td><?= rupiah($total); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <form method="post" action="<?= base_url('home/checkout') ?>">
                    <div class="row">
                        <!-- Left Side -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>No. HP</label>
                                <input type="hidden" name="total" value="<?= $total ?>" />
                                <input type="number" name="nohp" id="nohp" value="<?= session('nohp') ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Metode Pengiriman</label>
                                <select name="metodepengiriman" id="metodepengiriman" class="form-control" onchange="handleMetodePengiriman()" required>
                                    <option value="Kurir">Kurir</option>
                                    <option value="Ambil Sendiri">Ambil Sendiri</option>
                                </select>
                            </div>
                            <div id="tampil">
                                <div class="form-group">
                                    <label>Alamat Pengiriman</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= session('alamat') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kode POS</label>
                                    <input type="text" name="kd_pos" id="kodepos" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-sm-6" id="tampil2">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select name="prov" id="prov" class="form-control" required>
                                    <option value="" disabled selected>-Pilih Provinsi-</option>
                                    <?= $this->render('home/prov'); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kota/Kabupaten</label>
                                <select name="kota" id="kota" class="form-control" required>
                                    <option value="" disabled selected>-Kota/Kabupaten-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kurir</label>
                                <select name="kurir" id="kurir" class="form-control" required>
                                    <option value="pos">POS</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Layanan</label>
                                <select name="layanan" id="layanan" class="form-control" required>
                                    <option value="" disabled selected>-Layanan-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ongkir</label>
                                <input type="text" name="ongkir" id="ongkir" class="form-control" value="0" readonly required />
                            </div>
                            <div class="form-group">
                                <label>Total yang Harus Dibayar</label>
                                <input type="text" name="grandtotal" id="grandtotal" class="form-control" value="<?= $total ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <div class="form-check">
                                <input type="checkbox" name="sk" id="exampleCheckbox" class="form-check-input" required />
                                <label for="exampleCheckbox" class="form-check-label">
                                    Saya menyetujui S&K
                                    <br><a class="text-primary" data-toggle="modal" data-target="#sk">Lihat S & K</a>
                                </label>
                            </div>

                            <!-- Modal S&K -->
                            <div class="modal fade" id="sk" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Syarat & Ketentuan</h4>
                                            <ul>
                                                <li>Kelengkapan produk wajib disertakan (dus, charger).</li>
                                                <li>Barang yang rusak/hilang selama pengiriman tidak dijamin.</li>
                                                <li>Pembeli menanggung biaya retur.</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 my-auto">
                            <button type="submit" class="btn btn-primary float-right">Selesaikan Pesanan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->render('home/footer'); ?>

<!-- Style -->
<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    section {
        padding: 20px 0;
    }

    .breadcrumb_part {
        position: relative;
        background-color: #f5f5f5;
        background-blend-mode: overlay;
    }

    .breadcrumb_iner {
        background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background for text */
        padding: 20px;
        border-radius: 10px;
    }

    .breadcrumb_iner h2 {
        font-size: 36px;
        font-weight: 300;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .breadcrumb_iner p {
        font-size: 18px;
        color: #d9d9d9;
        margin-top: 10px;
    }

    /* Responsive Style */
    @media (max-width: 768px) {
        .breadcrumb_iner h2 {
            font-size: 28px;
        }
        
        .breadcrumb_iner p {
            font-size: 16px;
        }
    }

    .table th, .table td {
        border: none;
        padding: 12px 15px;
        color: #333;
    }

    .table {
        background-color: #fff;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .form-control {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 4px;
        color: #333;
        background-color: #f9f9f9;
    }

    .form-group label {
        color: #555;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-check-label {
        font-size: 14px;
    }

    .btn-primary {
        background-color: #333;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: #555;
    }

    .modal-content {
        border-radius: 6px;
        border: none;
        padding: 20px;
        background-color: #fff;
    }

    .modal-body h4 {
        font-size: 18px;
        color: #333;
    }

    .modal-body ul {
        padding-left: 20px;
    }

    .modal-body ul li {
        font-size: 14px;
        color: #555;
    }

    .modal-footer button {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
    }

    .modal-footer button:hover {
        background-color: #555;
    }
</style>

<!-- Script -->
<script>
    function handleMetodePengiriman() {
        var metodePengiriman = document.getElementById("metodepengiriman").value;
        var tampilDiv = document.getElementById("tampil");
        var tampilDiv2 = document.getElementById("tampil2");

    }
</script>