<?php

namespace App\Controllers;

use PDO;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Controllers\BaseController;
use CodeIgniter\Database\ConnectionInterface;

class Home extends BaseController
{
    protected $db;
    protected $kategoriModel;
    protected $produkModel;
    protected $helpers = ['form'];
    private $cart;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->produkModel = new ProdukModel();
        $this->db = db_connect();
        $this->cart = \Config\Services::cart();
    }
    public function index()
    {
        $data = [
            'title' => 'Home',
            'cart' => $this->cart,
            'produk' => $this->db->table('produk')->join('kategori', 'produk.idkategori = kategori.idkategori')->orderBy('idproduk', 'desc')->get()->getResult(),

        ];
        return view('home/home', $data);
    }
    public function daftar()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $session = session();
            $query = $this->db->table('pengguna')->where('email', $email)->where('password', $password)->where('level', 'Pembeli')->get();
            $cek = count($query->getResult());
            if ($cek >= 1) {
                session()->setFlashdata('error', 'Pendaftaran Gagal. Email sudah terdaftar, mohon gunakan email lainnya');
                return redirect()->to('/panel/daftar');
            } else {
                $simpan = [
                    'nama' => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    'nohp' => $this->request->getPost('nohp'),
                    'password' => $this->request->getPost('password'),
                    'level' => 'Pembeli',
                    'alamat' => $this->request->getPost('alamat'),
                ];
                $this->db->table('pengguna')->insert($simpan);
                session()->setFlashdata('success', 'Data berhasil ditambahkan.');
                return redirect()->to('/home/login');
            }
        } else {
            $data = [
                'title' => 'Daftar',
                'produk' => $this->db->table('produk')->join('kategori', 'produk.idkategori = kategori.idkategori')->orderBy('idproduk', 'desc')->get()->getResult(),

            ];
            return view('home/daftar', $data);
        }
    }
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $session = session();
            $query = $this->db->table('pengguna')->where('email', $email)->where('password', $password)->where('level', 'Pembeli')->get();
            $cek = count($query->getResult());
            $user = $query->getRow();
            if ($cek >= 1) {
                $session->set('idpengguna', $user->idpengguna);
                $session->set('nama', $user->nama);
                $session->set('email', $user->email);
                $session->set('nohp', $user->nohp);
                $session->set('level', $user->level);
                $session->set('alamat', $user->alamat);
                $session->setFlashdata('success', 'Login Berhasil');
                return redirect()->to('/home');
            } else {
                $session->setFlashdata('error', 'Login Gagal. Email atau Password anda salah');
                return redirect()->to('/home/login');
            }
        } else {
            $data = [
                'title' => 'Login',
                'produk' => $this->db->table('produk')->join('kategori', 'produk.idkategori = kategori.idkategori')->orderBy('idproduk', 'desc')->get()->getResult(),

            ];
            return view('home/login', $data);
        }
    }
    public function produkdaftar()
    {
        $data = [
            'title' => 'Daftar Produk',
            'produk' => $this->db->table('produk')->where('stok >=', '1')->join('kategori', 'produk.idkategori = kategori.idkategori')->orderBy('idproduk', 'desc')->get()->getResult(),

        ];
        return view('home/produkdaftar', $data);
    }
    public function kategoridaftar($id)
    {
        $row = $this->db->table('kategori')->where('idkategori', $id)->get()->getRow();
        $data = [
            'title' => 'Kategori : ' . $row->namakategori,
            'produk' => $this->db->table('produk')->where('produk.idkategori', $row->idkategori)->where('stok >=', '1')->join('kategori', 'produk.idkategori = kategori.idkategori')->orderBy('idproduk', 'desc')->get()->getResult(),

        ];
        return view('home/produkdaftar', $data);
    }
    public function produkdetail($id)
    {
        $data = [
            'title' => 'Detail Produk',
            'row' => $this->db->table('produk')->where('idproduk', $id)->get()->getRow(),

        ];
        return view('home/produkdetail', $data);
    }
    public function keranjangtambah()
    {
        $this->cart->insert(array(
            'id'      => $this->request->getPost('idproduk'),
            'qty'     => $this->request->getPost('jumlah'),
            'price'   => $this->request->getPost('harga'),
            'name'    => $this->request->getPost('namaproduk'),
        ));
        session()->setFlashdata('success', 'Produk berhasil disimpan ke keranjang');
        return redirect()->to('/home/keranjang');
    }
    public function keranjang()
    {
        $data = [
            'title' => 'Keranjang',
            'cart' => $this->cart,
        ];
        return view('home/keranjang', $data);
    }
    public function keranjanghapus($id)
    {
        $this->cart->remove($id);
        session()->setFlashdata('success', 'Produk berhasil dihapus dari keranjang');
        return redirect()->to('/home/keranjang');
    }
    public function checkout()
    {
        if (session('level') != 'Pembeli') {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('/home');
        }
        if ($this->request->getMethod() === 'post') {
            if ($this->request->getPost('metodepengiriman') == "Kurir") {
                $simpan = [
                    'idpengguna' => session('idpengguna'),
                    'nohp' => $this->request->getPost('nohp'),
                    'metodepengiriman' => $this->request->getPost('metodepengiriman'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kodepos' => $this->request->getPost('kd_pos'),
                    'provinsi' => $this->request->getPost('prov'),
                    'kota' => $this->request->getPost('kota'),
                    'kurir' => $this->request->getPost('kurir'),
                    'layanan' => $this->request->getPost('layanan'),
                    'provinsi' => $this->request->getPost('prov'),
                    'total' => $this->request->getPost('total'),
                    'ongkir' => $this->request->getPost('ongkir'),
                    'grandtotal' => $this->request->getPost('grandtotal'),
                    'status' => "Belum Mengupload Bukti Pembayaran",
                ];
            } else {
                $simpan = [
                    'idpengguna' => session('idpengguna'),
                    'nohp' => $this->request->getPost('nohp'),
                    'metodepengiriman' => $this->request->getPost('metodepengiriman'),
                    'alamat' => $this->request->getPost('alamat'),
                    'total' => $this->request->getPost('total'),
                    'ongkir' => 0,
                    'grandtotal' => $this->request->getPost('grandtotal'),
                    'status' => "Belum Mengupload Bukti Pembayaran",
                ];
            }
            $this->db->table('transaksi')->insert($simpan);
            $idtransaksi = $this->db->insertID();
            foreach ($this->cart->contents() as $keranjang) {
                $simpantransaksidetail = array(
                    'idtransaksi'        => $idtransaksi,
                    'idproduk'        => $keranjang['id'],
                    'jumlah'        => $keranjang['qty'],
                    'harga'         => $keranjang['price'],
                    'subtotal'         => $keranjang['qty'] * $keranjang['price'],
                );
                $this->db->table('transaksidetail')->insert($simpantransaksidetail);
            }
            $this->cart->destroy();
            session()->setFlashdata('success', 'Checkout berhasil');
            return redirect()->to(base_url('/home/transaksiriwayat'));
        } else {
            $data = [
                'title' => 'Checkout',
                'cart' => $this->cart,
            ];
            return view('home/checkout', $data);
        }
    }
    public function transaksiriwayat()
    {
        if (session('level') != 'Pembeli') {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Riwayat Transaksi',
            'riwayat' => $this->db->table('transaksi')->where('idpengguna', session('idpengguna'))->orderBy('idtransaksi', 'desc')->get()->getResult()
        ];
        return view('home/transaksiriwayat', $data);
    }
    public function transaksidetail($id)
    {
        if (session('level') != 'Pembeli') {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('/home');
        }
        if ($this->request->getMethod() === 'post') {
            $status = 'Pembayaran Menunggu Konfirmasi Toko';
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                session()->setFlashdata('success', 'Foto Bukti Pembayaran gagal di upload');
                return redirect()->to(base_url('/home/transaksidetail/' . $id));
            } else {

                $buktipembayaran = $foto->getRandomName();

                $foto->move('foto', $buktipembayaran);
            }
            $simpan = [
                'buktipembayaran' => $buktipembayaran,
                'status' => $status,
            ];
            $this->db->table('transaksi')->where('idtransaksi', $id)->update($simpan);
            session()->setFlashdata('success', 'Foto Bukti Pembayaran berhasil di upload. Mohon menunggu konfirmasi pembayaran oleh toko');
            return redirect()->to(base_url('/home/transaksidetail/' . $id));
        } else {
            $data = [
                'title' => 'Detail Transaksi',
                'row' => $this->db->table('transaksi')->where('idtransaksi', $id)->get()->getRow(),

            ];
            return view('home/transaksidetail', $data);
        }
    }
    public function transaksiselesaikanpesanan($id)
    {
        $simpan = [
            'status' => 'Selesai',
        ];
        $this->db->table('transaksi')->where('idtransaksi', $id)->update($simpan);
        session()->setFlashdata('success', 'Transaksi berhasil di selesaikan, terima kasih telah berbelanja di toko kami, Mohon berikan rating ya');
        return redirect()->to(base_url('/home/transaksiriwayat/'));
    }
    public function transaksiulasan($id)
    {
        if (session('level') != 'Pembeli') {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('/home');
        }
        if ($this->request->getMethod() === 'post') {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                session()->setFlashdata('success', 'Foto ulasan gagal di upload');
                return redirect()->to(base_url('/home/transaksiulasan/' . $id));
            } else {
                $fotoulasan = $foto->getRandomName();
                $foto->move('foto', $fotoulasan);
            }
            $simpan = [
                'idtransaksi' => $this->request->getPost('idtransaksi'),
                'idproduk' => $this->request->getPost('idproduk'),
                'idpengguna' => session('idpengguna'),
                'bintang' => $this->request->getPost('bintang'),
                'ulasan' => $this->request->getPost('ulasan'),
                'tampilannama' => $this->request->getPost('tampilannama'),
                'foto' => $fotoulasan,
            ];
            $this->db->table('ulasan')->insert($simpan);
            $update = [
                'statusulasan' => 'Sudah',
            ];
            $this->db->table('transaksidetail')->where('idtransaksidetail', $this->request->getPost('idtransaksidetail'))->update($update);
            session()->setFlashdata('success', 'Foto Bukti Pembayaran berhasil di upload. Mohon menunggu konfirmasi pembayaran oleh toko');
            return redirect()->to(base_url('/home/transaksiulasan/' . $id));
        } else {
            $data = [
                'title' => 'Berikan Ulasan',
                'row' => $this->db->table('transaksi')->where('idtransaksi', $id)->get()->getRow(),

            ];
            return view('home/transaksiulasan', $data);
        }
    }
    public function transaksiedit($id)
    {
        $update = [
            'bintang' => $this->request->getPost('rate'),
            'ulasan' => $this->request->getPost('ulasan'),
            'tampilannama' => $this->request->getPost('tampilannama'),
        ];
        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
        } else {
            $fotoulasan = $foto->getRandomName();
            $foto->move('foto', $fotoulasan);
            $update['foto'] = $fotoulasan;
        }
        $this->db->table('ulasan')->where('idulasan', $this->request->getPost('idulasan'))->update($update);
        session()->setFlashdata('success', 'Foto Bukti Pembayaran berhasil di upload. Mohon menunggu konfirmasi pembayaran oleh toko');
        return redirect()->to(base_url('/home/transaksiulasan/' . $id));
    }
    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Logout Berhasil.');
        return redirect()->to('/home');
    }
    public function city()
    {
        $prov = $this->request->getPost('prov');
        // $prov = 1;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$prov",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 7d0b4eeaf6bcd262bc67cd532a17055d"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, TRUE);
            echo '<option value="" selected disabled>Kota / Kabupaten</option>';
            for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
                echo '<option value="' . $data['rajaongkir']['results'][$i]['city_id'] . ',' . $data['rajaongkir']['results'][$i]['city_name'] . '">' . $data['rajaongkir']['results'][$i]['city_name'] . '</option>';
            }
        }
    }
    public function getcost()
    {
        $asal = 399;
        $dest = $this->request->getPost('dest');
        $kurir = $this->request->getPost('kurir');
        $berat = 0;
        foreach ($this->cart->contents() as $key) {
            $berat += (1 * $key['qty']);
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$asal&destination=$dest&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 7d0b4eeaf6bcd262bc67cd532a17055d"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, TRUE);
            echo '<option value="" selected disabled>Layanan yang tersedia</option>';
            for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
                for ($l = 0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {
                    echo '<option value="' . $data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'] . ',' . $data['rajaongkir']['results'][$i]['costs'][$l]['service'] . '(' . $data['rajaongkir']['results'][$i]['costs'][$l]['description'] . ')">';
                    echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'] . '(' . $data['rajaongkir']['results'][$i]['costs'][$l]['description'] . ')</option>';
                }
            }
        }
    }
    public function cost()
    {
        $biaya = explode(',', $this->request->getPost('layanan'));
        $total = $this->cart->total() + $biaya[0];
        echo $biaya[0] . ',' . $total;
    }
    public function profil()
    {
        if (session('level') != 'Pembeli') {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('/home');
        }
        $session = session();
        $id = session('idpengguna');
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'alamat' => $this->request->getPost('alamat'),
            ];
            if ($this->request->getPost('password') != "") {
                $simpan['password'] = $this->request->getPost('password');
            }
            $this->db->table('pengguna')->where('idpengguna', $id)->update($simpan);
            $session->set('nama', $this->request->getPost('nama'));
            $session->set('email', $this->request->getPost('email'));
            $session->set('nohp', $this->request->getPost('nohp'));
            $session->set('alamat', $this->request->getPost('alamat'));
            session()->setFlashdata('success', 'Profil berhasil di ubah');
            return redirect()->to(base_url('/home/profil/'));
        } else {
            $data = [
                'title' => 'Edit Profil',
                'row' => $this->db->table('pengguna')->where('idpengguna', $id)->get()->getRow(),
            ];
            return view('home/profil', $data);
        }
    }
    public function transaksibatal($id)
    {
        $this->db->table('transaksi')->where('idtransaksi', $id)->delete();
        $this->db->table('transaksidetail')->where('idtransaksi', $id)->delete();
        $this->db->table('ulasan')->where('idtransaksi', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/home/transaksiriwayat');
    }
}
