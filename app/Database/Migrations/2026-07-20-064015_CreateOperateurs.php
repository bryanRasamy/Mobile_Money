<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOperateurs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'TEXT',
            ],
            'mdp' => [
                'type' => 'TEXT',
            ],
            'id_role' => [
                'type'       => 'INTEGER',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('id_role', 'role', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->createTable('operateurs');
    }

    public function down()
    {
        $this->forge->dropTable('operateurs',true);
    }
}