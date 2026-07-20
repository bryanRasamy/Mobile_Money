<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBaremes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],
            'id_type' => [
                'type' => 'INTEGER',
            ],
            'valeur_min' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'valeur_max' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'montant' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'id_type',
            'type_operation',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->forge->createTable('baremes');
    }

    public function down()
    {
        $this->forge->dropTable('baremes',true);
    }
}