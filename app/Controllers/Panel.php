<?php

namespace App\Controllers;

use PDO;
use App\Models\KuponModel;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Controllers\BaseController;
use CodeIgniter\Database\ConnectionInterface;

class Panel extends BaseController
{
    protected $db;

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $session = session();
            $query = $this->db->table('pengguna')->where('email', $email)->where('password', $password)->get();
            $cek = count($query->getResult());
            $user = $query->getRow();
            if ($cek >= 1) {
                $session->set('idpengguna', $user->idpengguna);
                $session->set('nama', $user->nama);
                $session->set('email', $user->email);
                $session->set('nohp', $user->nohp);
                $session->set('level', $user->level);
                session()->setFlashdata('success', 'Login Berhasil');
                return redirect()->to('/panel');
            } else {
                session()->setFlashdata('error', 'Login Gagal. Silakan cek kembali email dan password Anda.');
                return redirect()->to('/panel/login');
            }
        } else {
            $data['title'] = 'Login';
            return view('panel/login', $data);
        }
    }
    public function index()
    {
        if (session('level') == 'Pemilik Toko' or session('level') == 'Pegawai' or session('level') == 'Admin') {
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to(base_url('panel/login'));
        }
        $data = [
            'title' => 'Selamat Datang, ' . session('nama'),
            'jumlahakunpembeli' => $this->db->table('pengguna')->where('level', 'Pembeli')->countAllResults(),
            'jumlahjenisproduk' => $this->db->table('produk')->countAllResults(),
        ];
        return view('panel/index', $data);
    }

    protected $kategoriModel;
    protected $produkModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->produkModel = new ProdukModel();
        $this->db = db_connect();
    }

    public function kategori()
    {
        $data = [
            'title' => 'Daftar Kategori',
            'kategori' => $this->kategoriModel->findAll(),
        ];
        return view('panel/kategori', $data);
    }

    public function tambahkategori()
    {

        $data = [
            'title' => 'Tambah Kategori',
            'validation' => \Config\Services::validation()

        ];

        return view('panel/tambahkategori', $data);
    }

    public function simpankategori()
    {
        $this->kategoriModel->save([
            'namakategori' => $this->request->getVar('namakategori')
        ]);

        return redirect()->to('/panel/kategori');
    }
    public function ubahkategori($idkategori)
    {
        $data = [
            'title' => 'Edit Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->where(['idkategori' => $idkategori])->first(),

        ];

        return view('panel/ubahkategori', $data);
    }

    public function updatekategori($idkategori)
    {
        $this->kategoriModel->save([
            'idkategori' => $idkategori,
            'namakategori' => $this->request->getVar('namakategori')
        ]);

        return redirect()->to('/panel/kategori');
    }

    public function hapuskategori($idkategori)
    {
        $this->kategoriModel->delete($idkategori);
        return redirect()->to('/panel/kategori');
    }

    public function produk()
    {
        $data = [
            'title' => 'Daftar Produk',
            'produk' => $this->produkModel->getAll(),
        ];
        return view('panel/produk', $data);
    }

    public function tambahproduk()
    {

        $data = [
            'title' => 'Tambah Produk',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $this->produkModel->findAll(),
        ];

        return view('panel/tambahproduk', $data);
    }

    public function simpanproduk()
    {
        // ambilgambar
        $fileSampul = $this->request->getFile('foto');

        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {

            $namaSampul = $fileSampul->getRandomName();

            $fileSampul->move('foto', $namaSampul);
        }

        $this->produkModel->save([
            'namaproduk' => $this->request->getVar('namaproduk'),
            'idkategori' => $this->request->getVar('idkategori'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'foto' => $namaSampul,
        ]);

        return redirect()->to('/panel/produk');
    }

    public function hapusproduk($idproduk)
    {
        $produk = $this->produkModel->find($idproduk);
        $this->produkModel->delete($idproduk);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/panel/produk');
    }


    public function ubahproduk($idproduk)
    {
        $data = [
            'title' => 'Edit Produk',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $this->produkModel->find($idproduk),
        ];

        return view('panel/ubahproduk', $data);
    }

    public function updateproduk($idproduk)
    {
        // ambilgambar
        $fileSampul = $this->request->getFile('foto');
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file randon
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('foto', $namaSampul);
        }
        $this->produkModel->save([
            'idproduk' => $idproduk,
            'namaproduk' => $this->request->getVar('namaproduk'),
            'idkategori' => $this->request->getVar('idkategori'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'foto' => $namaSampul
        ]);
        return redirect()->to('/panel/produk');
    }

    public function penggunatambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
            ];
            $this->db->table('pengguna')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to('/panel/penggunadaftar');
        } else {
            $data = [
                'title' => 'Tambah Pengguna',
                'produk' => $this->produkModel->getAll(),
            ];
            return view('panel/penggunatambah', $data);
        }
    }

    public function penggunaedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
            ];
            $this->db->table('pengguna')->where('idpengguna', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to('/panel/penggunadaftar');
        } else {
            $data = [
                'title' => 'Edit Pengguna',
                'id' => $id,
                'row' => $this->db->table('pengguna')->where('idpengguna', $id)->get()->getRow()

            ];
            return view('panel/penggunaedit', $data);
        }
    }

    public function penggunadaftar()
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'pengguna' => $this->db->table('pengguna')->where('level !=', 'Pembeli')->get()->getResult()

        ];
        return view('panel/penggunadaftar', $data);
    }

    public function penggunahapus($id)
    {
        $this->db->table('pengguna')->where('idpengguna', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/panel/penggunadaftar');
    }

    public function pembeliedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => 'Pembeli',
            ];
            $this->db->table('pengguna')->where('idpengguna', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to('/panel/pembelidaftar');
        } else {
            $data = [
                'title' => 'Edit Pembeli',
                'id' => $id,
                'row' => $this->db->table('pengguna')->where('idpengguna', $id)->get()->getRow()

            ];
            return view('panel/pembeliedit', $data);
        }
    }

    public function pembelidaftar()
    {
        $data = [
            'title' => 'Daftar Pembeli',
            'pembeli' => $this->db->table('pengguna')->where('level', 'Pembeli')->get()->getResult()
        ];
        return view('panel/pembelidaftar', $data);
    }

    public function pembelihapus($id)
    {
        $this->db->table('pengguna')->where('idpengguna', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/panel/pembelidaftar');
    }

    public function produkmasukdaftar()
    {
        $data = [
            'title' => 'Daftar Pembelian Produk',
            'produkmasuk' => $this->db->table('produkmasuk')->join('produk', 'produkmasuk.idproduk = produk.idproduk')->groupBy('kode')->get()->getResult()
        ];
        return view('panel/produkmasukdaftar', $data);
    }

    // kupon
    public function kupon(){
        $kuponmodel = new KuponModel();
        $kupon = $kuponmodel->findAll();
        $data =[
            'title' => 'Daftar Kelola Kupon',
            'kupon' => $kupon
        ];
        return view('panel/kupon',$data);
    }
    public function insert_kupon(){
        $kuponmodel = new KuponModel();
        $data = [
            'code' => $this->request->getPost('code'),
            'valid_until' => $this->request->getPost('valid_until'),
            'discount_percent' => $this->request->getPost('discount_percent'),
        ];
        $kuponmodel->insert($data);
        return redirect()->to('/panel/kupon');
    }
    public function delete_kupon($id_diskon){
        $kuponmodel = new KuponModel();
        $id_diskon = $kuponmodel->where('id_diskon', $id_diskon)->delete();
        return redirect()->to('/panel/kupon');
    }
    public function produkmasuktambah()
    {
        if ($this->request->getMethod() === 'post') {
            $kode = date('dmyHis');
            $tanggal = $this->request->getPost('tanggal');
            $idproduk = $this->request->getPost('idproduk');
            $simpan = [];
            foreach ($idproduk as $key => $val) {
                $simpan[] = [
                    'kode' => $kode,
                    'idproduk' => $this->request->getPost('idproduk')[$key],
                    'harga' => $this->request->getPost('harga')[$key],
                    'jumlah' => $this->request->getPost('jumlah')[$key],
                    'total' => $this->request->getPost('total')[$key],
                    'grandtotal' => $this->request->getPost('grandtotalnon'),
                    'tanggal' => $tanggal,
                    'supplier' => $this->request->getPost('supplier'),
                ];
                $this->db->table('produk')
                    ->set('stok', 'stok+' . $this->request->getPost('jumlah')[$key], false)
                    ->where('idproduk', $this->request->getPost('idproduk')[$key])
                    ->update();
            }
            $this->db->table('produkmasuk')->insertBatch($simpan);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to('/panel/produkmasukdaftar');
        } else {
            $data = [
                'title' => 'Tambah Pembelian Produk',
                'produk' => $this->db->table('produk')->get()->getResult(),
            ];
            return view('panel/produkmasuktambah', $data);
        }
    }

    public function produkmasukedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $ambilpembelian = $this->db->table('produkmasuk')->join('produk', 'produkmasuk.idproduk = produk.idproduk')->where('kode', $id)->get()->getResult();
            foreach ($ambilpembelian as $pembelian) {
                $this->db->table('produk')
                    ->set('stok', 'stok-' . $pembelian->jumlah, false)
                    ->where('idproduk', $pembelian->idproduk)
                    ->update();
            }
            $this->db->table('produkmasuk')->where('kode', $id)->delete();
            $tanggal = $this->request->getPost('tanggal');
            $idproduk = $this->request->getPost('idproduk');
            $simpan = [];
            foreach ($idproduk as $key => $val) {
                $simpan[] = [
                    'kode' => $this->request->getPost('kode'),
                    'idproduk' => $this->request->getPost('idproduk')[$key],
                    'harga' => $this->request->getPost('harga')[$key],
                    'jumlah' => $this->request->getPost('jumlah')[$key],
                    'total' => $this->request->getPost('total')[$key],
                    'grandtotal' => $this->request->getPost('grandtotalnon'),
                    'tanggal' => $tanggal,
                    'supplier' => $this->request->getPost('supplier'),
                ];
                $this->db->table('produk')
                    ->set('stok', 'stok+' . $this->request->getPost('jumlah')[$key], false)
                    ->where('idproduk', $this->request->getPost('idproduk')[$key])
                    ->update();
            }
            $this->db->table('produkmasuk')->insertBatch($simpan);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to('/panel/produkmasukdaftar');
        } else {
            $data = [
                'title' => 'Edit Pembelian Bahan Baku',
                'id' => $id,
                'produk' => $this->db->table('produk')->get()->getResult(),
                'row' => $this->db->table('produkmasuk')->where('kode', $id)->get()->getRow()

            ];
            return view('panel/produkmasukedit', $data);
        }
    }

    public function produkmasukhapus($id)
    {
        $ambilpembelian = $this->db->table('produkmasuk')->join('produk', 'produkmasuk.idproduk = produk.idproduk')->where('kode', $id)->get()->getResult();
        foreach ($ambilpembelian as $pembelian) {
            $this->db->table('produk')
                ->set('stok', 'stok-' . $pembelian->jumlah, false)
                ->where('idproduk', $pembelian->idproduk)
                ->update();
        }
        $this->db->table('produkmasuk')->where('kode', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/panel/produkmasukdaftar');
    }

    public function profiledit()
    {
        $idpengguna = session('idpengguna');
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
            ];
            $this->db->table('pengguna')->where('idpengguna', $idpengguna)->update($simpan);
            $session = session();
            $session->set('nama', $this->request->getPost('nama'));
            $session->set('email', $this->request->getPost('email'));
            $session->set('nohp', $this->request->getPost('nohp'));
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/profiledit');
        } else {
            $data = [
                'title' => 'Edit Profil',
                'id' => $idpengguna,
                'row' => $this->db->table('pengguna')->where('idpengguna', $idpengguna)->get()->getRow()

            ];
            return view('panel/profiledit', $data);
        }
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Logout Berhasil.');
        return redirect()->to('/panel/login');
    }

    public function laporanstokproduk()
    {
        $data = [
            'title' => 'Laporan Stok Produk',
            'produk' => $this->produkModel->getAll(),
        ];
        return view('panel/laporanstokproduk', $data);
    }

    public function laporanstokprodukcetak()
    {
        $data = [
            'title' => 'Laporan Stok Produk',
            'produk' => $this->produkModel->getAll(),
        ];
        return view('panel/laporanstokprodukcetak', $data);
    }

    public function laporanstokproduklama()
    {
        $data = [
            'title' => 'Laporan Stok Produk Lama',
            'produk' => $this->db->table('produk')->join('kategori', 'produk.idkategori = kategori.idkategori')->get()->getResultArray()
        ];
        return view('panel/laporanstokproduklama', $data);
    }

    public function laporanstokproduklamacetak()
    {
        $data = [
            'title' => 'Laporan Stok Produk Lama',
            'produk' => $this->db->table('produk')->join('kategori', 'produk.idkategori = kategori.idkategori')->get()->getResultArray()
        ];
        return view('panel/laporanstokproduklamacetak', $data);
    }

    public function transaksipesanan()
    {
        $data = [
            'title' => 'Pesanan Masuk',
            'riwayat' => $this->db->table('transaksi')->where('status', 'Pembayaran Menunggu Konfirmasi Toko')->orWhere('status', 'Barang Sedang di Kemas')->orWhere('status', 'Di Tolak')->orWhere('status', 'Barang Sudah Bisa Di Ambil di Toko')->orWhere('status', 'Barang Telah Di Ambil Pemesan')->orderBy('idtransaksi', 'desc')->get()->getResult()
        ];
        return view('panel/transaksipesanan', $data);
    }
    public function transaksipengiriman()
    {
        $data = [
            'title' => 'Pesanan Dalam Proses Pengiriman',
            'riwayat' => $this->db->table('transaksi')->where('status', 'Barang Sedang di Kirim')->orWhere('status', 'Barang Telah Sampai Ke Pemesan')->orderBy('idtransaksi', 'desc')->get()->getResult()
        ];
        return view('panel/transaksipengiriman', $data);
    }
    public function transaksiselesai()
    {
        $data = [
            'title' => 'Pesanan Selesai',
            'riwayat' => $this->db->table('transaksi')->where('status', 'Selesai')->orderBy('idtransaksi', 'desc')->get()->getResult()
        ];
        return view('panel/transaksiselesai', $data);
    }
    public function transaksidetail($id)
    {
        if ($this->request->getMethod() === 'post') {
            $status = $this->request->getPost('status');
            $simpan = [
                'status' => $status,
            ];
            if ($status == "Barang Sedang di Kirim") {
                $simpan['noresi'] = $this->request->getPost('noresi');
            }
            $this->db->table('transaksi')->where('idtransaksi', $id)->update($simpan);
            session()->setFlashdata('success', 'Status transaksi berhasil di update');
            if ($status == 'Barang Sedang di Kirim') {
                return redirect()->to(base_url('/panel/transaksipengiriman/'));
            } else if ($status == 'Barang Telah Sampai Ke Pemesan') {
                return redirect()->to(base_url('/panel/transaksipengiriman/'));
            } else if ($status == 'Barang Sudah Bisa Di Ambil di Toko') {
                return redirect()->to(base_url('/panel/transaksipesanan/'));
            } else if ($status == 'Barang Telah Di Ambil Pemesan') {
                return redirect()->to(base_url('/panel/transaksiselesai/'));
            } else if ($status == 'Selesai') {
                return redirect()->to(base_url('/panel/transaksiselesai/'));
            } else {
                return redirect()->to(base_url('/panel/transaksipesanan/'));
            }
        } else {
            $data = [
                'title' => 'Detail Transaksi',
                'row' => $this->db->table('transaksi')->where('idtransaksi', $id)->get()->getRow(),

            ];
            return view('panel/transaksidetail', $data);
        }
    }
    public function transaksipesananhapus($id)
    {
        $this->db->table('transaksi')->where('idtransaksi', $id)->delete();
        $this->db->table('transaksidetail')->where('idtransaksi', $id)->delete();
        $this->db->table('ulasan')->where('idtransaksi', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/panel/transaksipesanan');
    }
    public function transaksipengirimanhapus($id)
    {
        $this->db->table('transaksi')->where('idtransaksi', $id)->delete();
        $this->db->table('transaksidetail')->where('idtransaksi', $id)->delete();
        $this->db->table('ulasan')->where('idtransaksi', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/panel/transaksipengiriman');
    }
    public function transaksiselesaihapus($id)
    {
        $this->db->table('transaksi')->where('idtransaksi', $id)->delete();
        $this->db->table('transaksidetail')->where('idtransaksi', $id)->delete();
        $this->db->table('ulasan')->where('idtransaksi', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/panel/transaksiselesai');
    }

    public function laporanpemesanan()
    {
        if (!empty($this->request->getPost('tanggalawal'))) {
            $tanggalawal = $this->request->getPost('tanggalawal');
            $tanggalakhir = $this->request->getPost('tanggalakhir');
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idtransaksi', 'desc')->get()->getResult();
        } else {
            $tanggalawal = "kosong";
            $tanggalakhir = "kosong";
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->orderBy('idtransaksi', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Penjualan',
            'riwayat' => $query
        ];
        return view('panel/laporanpemesanan', $data);
    }

    public function laporanpemesanancetak($tanggalawal, $tanggalakhir)
    {
        if ($tanggalawal != "kosong") {
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idtransaksi', 'desc')->get()->getResult();
        } else {
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->orderBy('idtransaksi', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Penjualan',
            'riwayat' => $query
        ];
        return view('panel/laporanpemesanancetak', $data);
    }

    public function laporanpengiriman()
    {
        if (!empty($this->request->getPost('tanggalawal'))) {
            $tanggalawal = $this->request->getPost('tanggalawal');
            $tanggalakhir = $this->request->getPost('tanggalakhir');
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->where('status!=', 'Di Tolak')->where('noresi!=', '')->where('metodepengiriman', 'Kurir')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idtransaksi', 'desc')->get()->getResult();
        } else {
            $tanggalawal = "kosong";
            $tanggalakhir = "kosong";
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->where('status!=', 'Di Tolak')->where('noresi!=', '')->where('metodepengiriman', 'Kurir')->orderBy('idtransaksi', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pengiriman',
            'riwayat' => $query
        ];
        return view('panel/laporanpengiriman', $data);
    }

    public function laporanpengirimancetak($tanggalawal, $tanggalakhir)
    {
        if ($tanggalawal != "kosong") {
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->where('status!=', 'Di Tolak')->where('noresi!=', '')->where('metodepengiriman', 'Kurir')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idtransaksi', 'desc')->get()->getResult();
        } else {
            $query = $this->db->table('transaksi')->where('status!=', 'Pembayaran Menunggu Konfirmasi Toko')->where('status!=', 'Di Tolak')->where('noresi!=', '')->where('metodepengiriman', 'Kurir')->orderBy('idtransaksi', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pengiriman',
            'riwayat' => $query
        ];
        return view('panel/laporanpengirimancetak', $data);
    }
}
