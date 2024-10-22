<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'idproduk';
    protected $allowedFields    = ['idkategori', 'namaproduk', 'harga', 'stok', 'deskripsi', 'foto'];

    // Dates
    protected $useTimestamps = true;

    function getAll()
    {
        $builder = $this->db->table('produk');
        $builder->join('kategori', 'kategori.idkategori = produk.idkategori', 'LEFT');
        $query = $builder->get();

        return $query->getResultArray();
    }

    
}
