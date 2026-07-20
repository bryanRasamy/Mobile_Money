<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HistoriqueSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_client_depart' => 1,
                'id_client_arriver' => 2,
                'id_type' => 3,
                'montant' => 50000,
                'frais' => 1000,
                'date' => date('Y-m-d H:i:s'),
            ],
            [
                'id_client_depart' => 2,
                'id_client_arriver' => 3,
                'id_type' => 3,
                'montant' => 100000,
                'frais' => 2000,
                'date' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('historique')->insertBatch($data);
    }
}