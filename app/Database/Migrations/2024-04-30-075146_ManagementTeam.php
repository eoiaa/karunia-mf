<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ManagementTeam extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'management_team_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'management_team_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'management_team_job' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'management_team_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'management_team_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addKey('management_team_id', true);
        $this->forge->createTable('management_team');
    }

    public function down()
    {
        //
        $this->forge->dropTable('management_team');
    }
}
