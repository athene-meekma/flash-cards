<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCardSound extends Migration
{
    public function up()
    {
        $fields = [
            'sound_clip' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'after'      => 'definition',
            ]
        ];
        $this->forge->addColumn('cards', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('cards', 'sound_clip');
    }
}
