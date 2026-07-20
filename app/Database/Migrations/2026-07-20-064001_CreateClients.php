<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClients extends Migration
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
            'telephone' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'id_operateur' => [
                'type'       => 'INTEGER',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_role' => [
                'type'       => 'INTEGER',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_statut' => [
                'type'       => 'INTEGER',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('telephone');
        $this->forge->addForeignKey('id_operateur', 'operateurs', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_role', 'role', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_statut', 'statut_client', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients',true);
    }
}