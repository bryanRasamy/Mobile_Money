<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'telephone' => '0340000001',
                'id_role' => 1,
                'id_statut' => 1,
            ],
            [
                'telephone' => '0340000002',
                'id_role' => 1,
                'id_statut' => 2,
            ],
            [
                'telephone' => '0321234567',
                'id_role' => 1,
                'id_statut' => 1,
            ],
        ];

        $this->db->table('clients')->insertBatch($data);
    }
}