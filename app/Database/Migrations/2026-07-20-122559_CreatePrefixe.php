<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrefixe extends Migration
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
                'constraint' => 10,
            ],
            'id_operateur' => [
                'type' => 'INTEGER',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('prefixe');
    }

    public function down()
    {
        $this->forge->dropTable('prefixe',true);
    }
}