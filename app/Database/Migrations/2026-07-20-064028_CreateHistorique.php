<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistorique extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],

            'id_client_depart' => [
                'type' => 'INTEGER',
                'null' => true,
            ],

            'id_client_arriver' => [
                'type' => 'INTEGER',
                'null' => true,
            ],

            'id_type' => [
                'type' => 'INTEGER',
            ],

            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],

            'frais' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],

            'date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'id_client_depart',
            'clients',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->forge->addForeignKey(
            'id_client_arriver',
            'clients',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->forge->addForeignKey(
            'id_type',
            'type_operation',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->forge->createTable('historique');
    }

    public function down()
    {
        $this->forge->dropTable('historique', true);
    }
}

    
