<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'contact_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'contact_location' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'contact_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'contact_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addKey('contact_id', true);
        $this->forge->createTable('contact');
    }

    public function down()
    {
        //
        $this->forge->dropTable('contact');
    }
}
