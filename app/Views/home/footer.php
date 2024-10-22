<footer class="footer_part" style="padding-top:50px">
    <div class="copyright_part">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="copyright_text">
                        <p>©Copyright 2024 Subur Jaya Pekalongan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="<?= base_url('assets/home/') ?>js/jquery-1.12.1.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/jquery.magnific-popup.js"></script>
<script src="<?= base_url('assets/home/') ?>js/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/slick.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/jquery.counterup.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/waypoints.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/contact.js"></script>
<script src="<?= base_url('assets/home/') ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/jquery.form.js"></script>
<script src="<?= base_url('assets/home/') ?>js/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/home/') ?>js/mail-script.js"></script>
<script src="<?= base_url('assets/home/') ?>js/custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $(function() {
        <?php if (session()->has("success")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session("success") ?>'
            })
        <?php } ?>
    });
    $(function() {
        <?php if (session()->has("error")) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session("error") ?>'
            })
        <?php } ?>
    });
    $('.bdel').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({

            title: 'Yakin data ini akan dihapus?',
            text: "Data tidak akan bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    '',
                    'error'
                )
            }
        });
    });
</script>
<script>
    var inputField = document.getElementById('nohp');
    inputField.addEventListener('input', function() {
        if (this.value.length <= 13) {
            if (!this.value.startsWith('08')) {
                this.value = '08' + this.value; // Prepend '08' if it doesn't start with it
            }
        } else {
            this.value = this.value.substr(0, 13); // Limit the input to a maximum of 13 characters
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#prov').change(function() {
            var prov = $('#prov').val();
            var province = prov.split(',');
            $.ajax({
                url: "<?php echo base_url(); ?>home/city",
                method: "POST",
                data: {
                    prov: province[0]
                },
                success: function(obj) {
                    $('#kota').html(obj);
                }
            });
        });
        $('#kota').change(function() {
            var kota = $('#kota').val();
            var dest = kota.split(',');
            var kurir = $('#kurir').val()
            $.ajax({
                url: "<?php echo base_url(); ?>home/getcost",
                method: "POST",
                data: {
                    dest: dest[0],
                    kurir: kurir
                },
                success: function(obj) {
                    $('#layanan').html(obj);
                }
            });
        });
        $('#kurir').change(function() {
            var kota = $('#kota').val();
            var dest = kota.split(',');
            var kurir = $('#kurir').val()

            $.ajax({
                url: "<?php echo base_url(); ?>home/getcost",
                method: "POST",
                data: {
                    dest: dest[0],
                    kurir: kurir
                },
                success: function(obj) {
                    $('#layanan').html(obj);
                }
            });
        });
        $('#layanan').change(function() {
            var layanan = $('#layanan').val();
            $.ajax({
                url: "<?php echo base_url(); ?>home/cost",
                method: "POST",
                data: {
                    layanan: layanan
                },
                success: function(obj) {
                    var hasil = obj.split(",");

                    $('#ongkir').val(hasil[0]);
                    $('#grandtotal').val(hasil[1]);
                }
            });
        });

    });
</script>
</body>

</html>