<html>
<title>Laporan Stok Produk Lama</title>
<style type="text/css">
    body {
        -webkit-print-color-adjust: exact;
        padding: 50px;
    }

    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #table td,
    #table th {
        padding: 8px;
        padding-top: 5px;
        border: 1px solid black;
    }

    #table tr {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: left;
        background-color: #2f5aae;
        color: white;
    }

    @page {
        size: auto;
        margin: 0;
    }
</style>

<body>
    <table style='width:600; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
        <tr>
            <td><img src="<?= base_url('foto/logo.webp') ?>" width="90" height="90"></td>
            <td>
                <center>
                    <font size="6"><b>VISUAL CELLULAR</b></font><br>
                    <font size="2">Mall Seasons City Lt.LG blok A9 Jl. Prof. DR Latumenten Jembatan Besi Jakarta Barat<br>
                        Telp. 0856-9111-3122
                    </font><br>
                </center>
            </td>
        </tr>
    </table>
    <br>
    <center>
        <h4>LAPORAN STOK PRODUK LAMA<br><?= strtoupper(tanggal(date('Y-m-d'))) ?></h4>
    </center>
    <br>
    <table class="table table-bordered table-striped" id="table" width="670px">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($produk as $p) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $p['namaproduk']; ?></td>
                    <td><?= $p['namakategori']; ?></td>
                    <td>
                        <?= $p['stok'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>