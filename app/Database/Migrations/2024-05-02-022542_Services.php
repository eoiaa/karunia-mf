<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'services_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'services_logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'services_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'services_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'services_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addKey('services_id', true);
        $this->forge->createTable('services');
    }

    public function down()
    {
        //
        $this->forge->dropTable('services');
    }
}
