<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatRoomModel extends Model {
    protected $table = 'chat_room';
    protected $primaryKey = 'id_room';
    protected $allowedFields = ['idpengguna_1', 'idpengguna_2', 'created_at'];
}
?>