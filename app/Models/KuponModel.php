<?php

namespace App\Models;

use CodeIgniter\Model;

class KuponModel extends Model
{
    protected $table = 'kupon';
    protected $allowedFields = ['code', 'discount_percent','valid_until'];

    public function getCoupon($code)
    {
        return $this->where('code', $code)
            ->where('valid_until >=', date('Y-m-d'))
            ->first();
    }
}
