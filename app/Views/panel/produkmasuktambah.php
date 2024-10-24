<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('panel/produkmasuktambah') ?>" method="post">
                        <div class="form-group">
                            <label>Tanggal Pembelian</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <input type="text" class="form-control" name="supplier">
                        </div>
                        <br>
                        <table class="table table-bordered table-striped" id="tabelform">
                            <tr>
                                <td width="30%">
                                    <div class="form-group idprodukharga">
                                        <label class="mb-2">Nama Produk</label>
                                        <select name="idproduk[]" id="" data-width="100%" class="form-control idproduk selectcari" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($produk as $data) { ?>
                                                <option value="<?= $data->idproduk ?>"><?= $data->namaproduk ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-3">
                                        <label class="mb-2">Harga Satuan</label>
                                        <input type="text" value="0" name="harga[]" oninput="check()" onchange="check()" class="form-control harga" required>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">Jumlah</label>
                                        <input type="number" value="1" min="0" name="jumlah[]" oninput="check()" onchange="check()" class="form-control jumlah" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-3">
                                        <label class="mb-2">Total</label>
                                        <input type="text" name="total[]" value="0" class="form-control total" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-3">
                                        <button type="button" name="add" id="addkegiatan" class="btn btn-success" style="margin-top:30px">+</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Total Harga Barang</label>
                                    <input class="form-control" id="grandtotal" name="grandtotal" type="number" readonly>
                                    <input class="form-control" id="grandtotalnon" name="grandtotalnon" type="hidden" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        var i = 1;

        $('#addkegiatan').click(function() {
            i++;
            var html = `
            <tr id="row${i}">
                <td width="30%">
                    <div class="form-group idprodukharga">
                        <label class="mb-2">Nama Produk</label>
                        <select name="idproduk[]" class="form-control idproduk selectcari" required>
                            <option value="">Pilih</option>
                            <?php foreach ($produk as $data) { ?>
                                <option value="<?= $data->idproduk ?>"><?= $data->namaproduk ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-3">
                        <label class="mb-2">Harga</label>
                        <input type="number" name="harga[]" value="0" class="form-control harga" oninput="check()" onchange="check()" required>
                    </div>
                </td>
                <td width="15%">
                    <div class="form-group mb-3">
                        <label class="mb-2">Jumlah</label>
                        <input type="number" value="1" min="0" name="jumlah[]" class="form-control jumlah" oninput="check()" onchange="check()" required>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-3">
                        <label class="mb-2">Total</label>
                        <input type="text" name="total[]" class="form-control total" value="0" readonly>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-3">
                        <button type="button" name="remove" class="btn btn-danger btn_remove" style="margin-top:30px">X</button>
                    </div>
                </td>
            </tr>`;

            $('#tabelform').append(html);
        });

        $(document).on('click', '.btn_remove', function() {
            $(this).closest('tr').remove();
            hitunggrandtotal()
        });

        $(document).on('input', '.jumlah', function() {
            var $row = $(this).closest('tr');
            var jumlah = $(this).val();
            var harga = $row.find('.harga').val();
            var total = parseInt(jumlah) * parseInt(harga);
            if (!isNaN(total)) {
                $row.find('.total').val(total);
            } else {
                $row.find('.total').val(0);
            }

            hitunggrandtotal(); // Recalculate grand total after changing quantity
        });

        $(document).on('change', '.jumlah', function() {
            hitunggrandtotal(); // Recalculate grand total after changing quantity
        });

        $(document).on('input', '.harga', function() {
            var $row = $(this).closest('tr');
            var jumlah = $row.find('.jumlah').val();
            var harga = $(this).val();
            var total = parseInt(jumlah) * parseInt(harga);
            if (!isNaN(total)) {
                $row.find('.total').val(total);
            } else {
                $row.find('.total').val(0);
            }

            hitunggrandtotal(); // Recalculate grand total after changing price
        });

        $(document).on('change', '.harga', function() {
            hitunggrandtotal(); // Recalculate grand total after changing price
        });

        $(document).ready(function() {
            $(".total").each(function() {
                setInterval(hitunggrandtotal, 100);
            });
        });

        function hitunggrandtotal() {
            var sum = 0;
            $(".total").each(function() {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('#grandtotal').val(sum.toFixed(2));
            $('#grandtotalnon').val(sum);

            $(".subtotal").each(function(index) {
                var jumlah = $(this).closest('tr').find('.jumlah').val();
                var harga = $(this).closest('tr').find('.harga').val();
                var total = parseInt(jumlah) * parseInt(harga);
                if (!isNaN(total)) {
                    $(this).val(total);
                } else {
                    $(this).val(0);
                }
            });
        }
    });
</script>
<?= $this->endSection(); ?>