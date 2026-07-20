<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaremesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_type' => 3,
                'valeur_min' => 0,
                'valeur_max' => 50000,
                'montant' => 1000,
            ],
            [
                'id_type' => 3,
                'valeur_min' => 50001,
                'valeur_max' => 100000,
                'montant' => 2000,
            ],
            [
                'id_type' => 3,
                'valeur_min' => 100001,
                'valeur_max' => 500000,
                'montant' => 5000,
            ],
            [
                'id_type' => 3,
                'valeur_min' => 500001,
                'valeur_max' => 1000000,
                'montant' => 10000,
            ],
        ];

        $this->db->table('baremes')->insertBatch($data);
    }
}