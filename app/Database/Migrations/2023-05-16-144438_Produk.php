<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idproduk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'idkategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'namaproduk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'stok' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',

            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('idproduk', true);
        $this->forge->addForeignKey('idkategori', 'kategori', 'idkategori', 'CASCADE', 'CASCADE');
        $this->forge->createTable('produk', true);
    }

    public function down()
    {
        $this->forge->dropForeignKey('produk', 'produk_idkategori_foreign');
        $this->forge->dropTable('produk');
    }
}
