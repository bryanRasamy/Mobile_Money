<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixHistoriqueNullable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('historique', [
            'id_client_depart' => [
                'name' => 'id_client_depart',
                'type' => 'INTEGER',
                'null' => true,
            ],
            'id_client_arriver' => [
                'name' => 'id_client_arriver',
                'type' => 'INTEGER',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // pas de rollback simple sur SQLite pour cette contrainte
    }
}