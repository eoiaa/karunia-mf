<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class About extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'about_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'about_description_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'about_description_desc' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'about_description_right_section' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'about_vision' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'about_mission' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'about_company_history' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],

        ]);
        $this->forge->addKey('about_id', true);
        $this->forge->createTable('about');
    }

    public function down()
    {
        //
        $this->forge->dropTable('about');
    }
}
