<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Achievement extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'achievement_id' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'achievement_image' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'achievement_title' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'achievement_description' => [
                'type' => 'longtext'
            ],
            'achievement_date' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'achievement_timestamp timestamp default now()'
        ]);
        $this->forge->addKey('achievement_id', true);
        $this->forge->createTable('achievement');
    }

    public function down()
    {
        //
        $this->forge->dropTable('achievement');
    }
}
