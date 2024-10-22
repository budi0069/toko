<?php

namespace App\Controllers;

use App\Models\ChatModel;
use CodeIgniter\Controller;

class Chat extends Controller {
    
    private $chatModel;

    public function __construct() {
        $this->chatModel = new ChatModel();
    }

    public function index() {
        // Ambil data chat
        $data = [
            'data' => $this->chatModel->findAll()
        ];

        return view('chat', $data);
    }

    public function sendMessage() {
        // Cek jika pengguna login dan mengambil nama dari session
        if (session('level') == 'Pembeli') {
            $nama = session('nama'); // Ambil nama dari session
            $namaArray = explode(" ", $nama);
            $username = $namaArray[0]; // Ambil nama depan sebagai username
        } else {
            // Jika bukan pembeli, atur username sesuai kebutuhan
            $username = 'Admin'; // Misalnya, bisa diatur sesuai logika admin
        }

        // Ambil data dari form
        $message = $this->request->getPost('message');

        // Atur timezone agar timestamp sesuai
        date_default_timezone_set('Asia/Jakarta'); 
        
        // Buat array data untuk disimpan ke database
        $data = [
            'username' => $username, // Gunakan nama yang diambil dari session
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s') // Tambahkan timestamp sesuai kebutuhan
        ];

        // Simpan data ke dalam tabel 'messages'
        $this->chatModel->insert($data);

        // Redirect kembali ke halaman chat setelah mengirim pesan
        return redirect()->to(base_url('chat'));
    }
}

?>
