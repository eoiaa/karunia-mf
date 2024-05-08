<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Messages extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'messages_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'messages_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'messages_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'messages_subject' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'messages_description' => [
                'type' => 'longtext',
            ]
        ]);
        $this->forge->addKey('messages_id', true);
        $this->forge->createTable('messages');
    }

    public function down()
    {
        //
        $this->forge->dropTable('messages');
    }
}
