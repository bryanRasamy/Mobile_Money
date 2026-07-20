<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HistoriqueSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_client_depart'  => 1,
                'id_type'           => 2,
                'id_client_arriver' => 2,
                'montant'           => 25000,
                'frais'             => 1000,
                'date'              => '2026-07-20 08:00:00',
            ],
            [
                'id_client_depart'  => 3,
                'id_type'           => 2,
                'id_client_arriver' => 3,
                'montant'           => 75000,
                'frais'             => 2000,
                'date'              => '2026-07-20 09:15:00',
            ],
            [
                'id_client_depart'  => 3,
                'id_type'           => 3,
                'id_client_arriver' => 1,
                'montant'           => 200000,
                'frais'             => 5000,
                'date'              => '2026-07-20 10:30:00',
            ],
            [
                'id_client_depart'  => 2,
                'id_type'           => 3,
                'id_client_arriver' => 1,
                'montant'           => 800000,
                'frais'             => 10000,
                'date'              => '2026-07-20 11:45:00',
            ],
            [
                'id_client_depart'  => 3,
                'id_type'           => 3,
                'id_client_arriver' => 2,
                'montant'           => 50000,
                'frais'             => 1000,
                'date'              => '2026-07-20 12:10:00',
            ],
        ];

        $this->db->table('historique')->insertBatch($data);
    }
}