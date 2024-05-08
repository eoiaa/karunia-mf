<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnPosts extends Migration
{
    public function up()
    {
        $field = [
            'post_file' => ['type' => 'VARCHAR(255)']
        ];
        $this->forge->addColumn('posts', $field);
    }

    public function down()
    {
        //
    }
}
