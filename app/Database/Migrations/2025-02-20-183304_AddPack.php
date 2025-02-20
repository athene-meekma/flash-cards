<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPack extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('packs', true);

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pack_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'word' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'definition' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['pack_id', 'word'], false, true, 'pack_word');
        $this->forge->addForeignKey('pack_id', 'packs', 'id', 'CASCADE', 'CASCADE', 'pack_id');
        $this->forge->createTable('cards', true);
    }

    public function down()
    {
        $this->forge->dropTable('packs', true);
        $this->forge->dropTable('cards', true);
    }
}
