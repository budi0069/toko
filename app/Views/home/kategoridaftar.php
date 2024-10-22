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
<section class="trending_items">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Belanja Sekarang</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($produk as $row) { ?>
                <div class="col-md-6">
                    <div class="single_product_item">
                        <div class="single_product_item_thumb">
                            <a href="<?= base_url('home/produkdetail/' . $row->idproduk) ?>">
                                <img src="<?= base_url('foto/' . $row->foto) ?>" style="width: 100%;height:300px;object-fit:cover" alt="#" class="img-fluid">
                            </a>
                        </div>
                        <h3><a href="<?= base_url('home/produkdetail/' . $row->idproduk) ?>"><?= $row->namaproduk ?></a> </h3>
                        <p>
                            <?= rupiah($row->harga); ?>
                            <br>
                            <span>Stok : <?= $row->stok ?></span>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?= $this->render('home/footer'); ?>