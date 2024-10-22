<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model {
    protected $table = 'messages';
    protected $primaryKey = 'id_message';
    protected $allowedFields = ['id_room', 'idpengguna', 'message', 'created_at'];
}
