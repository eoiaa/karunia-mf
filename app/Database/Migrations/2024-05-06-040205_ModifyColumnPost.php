<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnPost extends Migration
{
    public function up()
    {
        //
        $this->forge->modifyColumn('posts', ['post_description longtext']);
    }

    public function down()
    {
        //
    }
}
