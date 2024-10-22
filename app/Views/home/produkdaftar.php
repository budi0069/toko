<?= $this->render('home/header'); ?>

<!-- Hero Section -->
<section class="hero_section text-center py-5" style="background-image: url('<?= base_url('foto/DetailSepatu.jpg') ?>'); background-size: cover; background-position: center; height: 500px; position: relative; color: white;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="hero_content">
            <h1 class="display-4 font-weight-bold" style="color: white;">HARMONY IN SOUND</h1>
            <p class="lead" style="color: white;">Experience the Sublime Harmony of Yuqos Audio – Where Immaculate Sound Meets Unprecedented Serenity</p>
            <a href="#" class="btn btn-light btn-lg mt-4">Discover Audio Bliss</a>
        </div>
    </div>
</section>

<!-- Product Grid Section -->
<section class="products_section py-5">
    <div class="container">
        <!-- Category Tabs -->
        <div class="row mb-4 text-center">
            <div class="col-lg-12">
                <h2 class="section_title">Kategori Sepatu</h2>
                <ul class="nav justify-content-center mb-3">
                <li class="nav-item" style="margin-right: 15px;">
                    <a class="nav-link active" href="http://localhost:8080/home/kategoridaftar/4" style="padding: 10px 20px; border-radius: 25px; text-decoration: none; color: #fff;
                        background-color: #333; transition: background-color 0.3s ease;">
                        Pria
                    </a>
                </li>
                <li class="nav-item" style="margin-right: 15px;">
                    <a class="nav-link" href="http://localhost:8080/home/kategoridaftar/5" style="padding: 10px 20px; border-radius: 25px; text-decoration: none; color: #fff;
                        background-color: #333; transition: background-color 0.3s ease;">
                        Wanita
                    </a>
                </li>
                <li class="nav-item" style="margin-right: 15px;">
                    <a class="nav-link active" href="http://localhost:8080/home/kategoridaftar/4" style="padding: 10px 20px; border-radius: 25px; text-decoration: none; color: #fff;
                        background-color: #333; transition: background-color 0.3s ease;">
                        Anak
                    </a>
                </li>
                <li class="nav-item" style="margin-right: 15px;">
                    <a class="nav-link" href="http://localhost:8080/home/kategoridaftar/5" style="padding: 10px 20px; border-radius: 25px; text-decoration: none; color: #fff;
                        background-color: #333; transition: background-color 0.3s ease;">
                        Bayi
                    </a>
                </li>
                </ul>
            </div>
        </div>

        <!-- Product Cards Grid -->
        <div class="row">
            <?php foreach ($produk as $row) { ?>
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="product-card border rounded shadow-sm position-relative text-center" style="background-color: #ffffff; border-radius: 15px; transition: transform 0.3s ease; overflow: hidden;">
                        <!-- Product Image -->
                        <div class="product-image mb-3" style="height: 200px; overflow: hidden; border-radius: 15px 15px 0 0;">
                            <a href="<?= base_url('home/produkdetail/' . $row->idproduk) ?>">
                                <img src="<?= base_url('foto/' . $row->foto) ?>" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" alt="<?= $row->namaproduk ?>">
                            </a>
                        </div>

                        <!-- Product Info -->
                        <div class="product-info p-3" style="background-color: #f8f9fa;">
                            <h5 class="product-title" style="margin-bottom: 0.5rem;">
                                <a href="<?= base_url('home/produkdetail/' . $row->idproduk) ?>" class="text-dark" style="text-decoration: none;"><?= $row->namaproduk ?></a>
                            </h5>
                            <p class="product-price text-muted" style="margin-bottom: 0.5rem;"><?= rupiah($row->harga); ?></p>
                            <p class="product-stock small" style="margin-bottom: 0;">Stock: <?= $row->stok ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?= $this->render('home/footer'); ?>
