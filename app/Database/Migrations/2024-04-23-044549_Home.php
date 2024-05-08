<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Home extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'home_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'home_jumbotron_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'home_jumbotron_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'home_jumbotron_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'home_jumbotron_button_text' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'home_jumbotron_button_link' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addKey('home_id', true);
        $this->forge->createTable('home');
    }

    public function down()
    {
        //
        $this->forge->dropTable('home');
    }
}
