<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeOperationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom_operation' => 'Dépôt',
                'commission' => 10,
                'promotion' => 0
                
            ],
            [
                'nom_operation' => 'Retrait',
                'commission' => 15,
                'promotion' => 0
            ],
            [
                'nom_operation' => 'Transfert',
                'commission' => 20,
                'promotion' => 10
            ],
        ];

        $this->db->table('type_operation')->insertBatch($data);
    }
}

