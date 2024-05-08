<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Brand extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'brand_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'brand_logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'brand_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addKey('brand_id', true);
        $this->forge->createTable('brand');
    }

    public function down()
    {
        //
        $this->forge->dropTable('brand');
    }
}
