<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatutClient extends Migration
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
        $this->forge->createTable('statut_client');
    }

    public function down()
    {
        $this->forge->dropTable('statut_client',true);
    }
}