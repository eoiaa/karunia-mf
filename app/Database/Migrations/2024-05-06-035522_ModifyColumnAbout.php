<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnAbout extends Migration
{
    public function up()
    {
        //
        $this->forge->modifyColumn('about', ['about_description_right_section longtext', 'about_mission longtext', 'about_company_history longtext']);
    }

    public function down()
    {
        //
    }
}
