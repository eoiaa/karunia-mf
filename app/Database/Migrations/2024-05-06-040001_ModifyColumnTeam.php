<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnTeam extends Migration
{
    public function up()
    {
        //
        $this->forge->modifyColumn('management_team', ['management_team_description longtext']);
    }

    public function down()
    {
        //
    }
}
