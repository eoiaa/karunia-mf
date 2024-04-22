<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jumbotron extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'jumbotron_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'jumbotron_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jumbotron_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jumbotron_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jumbotron_button_text' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jumbotron_button_link' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addKey('jumbotron_id', true);
        $this->forge->createTable('jumbotron');
    }

    public function down()
    {
        //
        $this->forge->dropTable('jumbotron');
    }
}
