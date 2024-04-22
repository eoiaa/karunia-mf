<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konfigurasi extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'konfigurasi_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'konfigurasi_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'konfigurasi_value' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addKey('konfigurasi_id', true);
        $this->forge->createTable('konfigurasi');
    }

    public function down()
    {
        //
    }
}
