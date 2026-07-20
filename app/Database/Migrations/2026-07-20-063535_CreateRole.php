<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],
            'libelle' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('role');
    }

    public function down()
    {
        $this->forge->dropTable('role',true);
    }
}