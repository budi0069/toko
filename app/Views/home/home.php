<?= $this->render('home/header'); ?>

<!-- Hero Section -->
<section class="hero-section py-5" style="background-color: #f1f5f9;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 font-weight-bold">Shopping And Department Store.</h1>
                <p class="lead">Belanja Sepatu Thrifting Berkualitas Hanya Di Subur Jaya, Dijamin Paling Murah Dan Barang Terjamin</p>
                <a href="<?= base_url('home/produkdaftar') ?>" class="btn btn-dark btn-lg">Shop Now</a>
            </div>
            <div class="col-md-6">
                <img src="<?= base_url('foto/jordan.png') ?>" alt="Shopping and Department Store" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section py-5">
    <div class="container">
        <h2 class="text-center font-weight-bold mb-5">Tersedia Banyak Pilihan</h2>
        <div class="row justify-content-center text-center">
            <div class="col-md-2">
                <div class="category-item">
                    <img src="<?= base_url('foto/Casual.jpg') ?>" alt="Furniture" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    <h5>Casual</h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item">
                    <img src="<?= base_url('foto/Korean.jpg') ?>" alt="Hand Bag" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    <h5>Hand Bag</h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item">
                    <img src="<?= base_url('foto/Eksekutif.jpg') ?>" alt="Books" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    <h5>Eksekutif</h5>
                </div>
            </div>
            <div class="col-md-2">
            <div class="category-item">
                    <img src="<?= base_url('foto/Starboy.jpg') ?>" alt="Furniture" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    <h5>Starboy</h5>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Banner Section -->
<section class="banner-section py-5 bg-light">
    <div class="container text-center">
        <h2 class="display-5 font-weight-bold mb-4">Shopping And Department Store</h2>
        <p class="lead">Get the best offers and discounts on a variety of products. Explore now and start shopping!</p>
        <a href="<?= base_url('home/produkdaftar') ?>" class="btn btn-primary btn-lg">Shop Now</a>
    </div>
</section>

<?= $this->render('home/footer'); ?>
