<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{

    protected $table      = 'kategori';
    protected $primaryKey = 'idkategori';

    protected $allowedFields = ['namakategori'];

    protected $useTimestamps = true;


    // protected $validationRules    = [
    //     'namakategori'    => 'required',
    // ];

}
