<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldAchievementCat extends Migration
{
    public function up()
    {
        //
        $field = [
            'achievement_category' => ['type' => 'VARCHAR(255)']
        ];
        $this->forge->addColumn('achievement', $field);
    }

    public function down()
    {
        //
    }
}
