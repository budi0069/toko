<?= $this->render('home/header'); ?>

<section class="breadcrumb_part bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center"><?= $row->namaproduk ?></h2>
            </div>
        </div>
    </div>
</section>

<section class="product-detail-section my-5">
    <div class="container">
        <div class="row">
            <!-- Left section for product images -->
            <div class="col-md-6">
                <div class="product-main-image mb-4">
                    <img src="<?= base_url('foto/' . $row->foto) ?>" class="img-fluid" alt="<?= $row->namaproduk ?>" style="border-radius: 10px;">
                </div>
                <div class="product-thumbnail-images d-flex">
                    <!-- Thumbnail images (if any additional images exist) -->
                    <img src="<?= base_url('foto/' . $row->foto) ?>" class="img-thumbnail mx-1" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                    <!-- Add more thumbnails if there are more product images -->
                </div>
            </div>

            <!-- Right section for product details -->
            <div class="col-md-6">
                <h3 class="font-weight-bold"><?= $row->namaproduk ?></h3>
                <div class="product-price mb-3">
                    <h4 class="text-danger"><?= rupiah($row->harga); ?></h4>
                </div>

                <div class="product-stock mb-3">
                    <span class="text-muted">Stok: <?= $row->stok ?></span>
                </div>

                <div class="product-description mb-4">
                    <p><?= $row->deskripsi ?></p>
                </div>

                <form method="post" action="<?= base_url('home/keranjangtambah') ?>">
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="hidden" name="idproduk" id="idproduk" value="<?= $row->idproduk ?>">
        <input type="hidden" name="harga" id="harga" value="<?= $row->harga ?>">
        <input type="hidden" name="stok" id="stok" value="<?= $row->stok ?>">
        <input type="hidden" name="namaproduk" id="namaproduk" value="<?= $row->namaproduk ?>">
        <!-- Validasi minimum jumlah sesuai stok -->
        <input type="number" name="jumlah" id="jumlah" value="1" class="form-control w-25" min="1" max="<?= $row->stok ?>" required>
    </div>
    <button type="submit" class="btn btn-dark btn-lg btn-block">Masukkan Ke Keranjang</button>
</form>

            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h4>Ulasan</h4>
                <div class="review-section">
                    <?php
                    $query = $this->db->table('ulasan')
                        ->select('*')
                        ->join('pengguna', 'pengguna.idpengguna = ulasan.idpengguna', 'left')
                        ->where('ulasan.idproduk', $row->idproduk)
                        ->orderBy('waktu', 'desc')
                        ->get();
                    $ambilulasan = $query->getResult();
                    $cekulasan = count($ambilulasan);
                    if ($cekulasan >= 1) : ?>
                        <?php foreach ($ambilulasan as $ulasan) :
                            $bintang = "";
                            for ($i = 1; $i <= 5; $i++) {
                                $bintang .= ($ulasan->bintang >= $i) ? '<span class="fa fa-star text-warning"></span>' : '<span class="fa fa-star text-muted"></span>';
                            }
                        ?>
                            <div class="card my-3 p-3">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h5 class="text-primary"><?= $ulasan->nama ?></h5>
                                        <div class="rating">
                                            <?= $bintang ?>
                                        </div>
                                        <p class="mt-2"><?= $ulasan->ulasan ?></p>
                                        <p class="text-muted"><?= tanggal(date('Y-m-d', strtotime($ulasan->waktu))) ?></p>
                                    </div>
                                    <?php if (!empty($ulasan->foto)) : ?>
                                        <div class="col-md-3">
                                            <img src="<?= base_url('foto/' . $ulasan->foto) ?>" class="img-fluid rounded" alt="Review Image">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center">Belum ada ulasan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->render('home/footer'); ?>
<script>
    // Script to ensure jumlah doesn't exceed stock
    var jumlahInput = document.getElementById('jumlah');
    var stokInput = document.getElementById('stok');
    jumlahInput.addEventListener('input', function() {
        if (parseInt(jumlahInput.value) > parseInt(stokInput.value)) {
            jumlahInput.value = stokInput.value;
        }
    });
</script>
