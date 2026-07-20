<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatutClientSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => 'Actif'],
            ['libelle' => 'Inactif'],
        ];

        $this->db->table('statut_client')->insertBatch($data);
    }
}