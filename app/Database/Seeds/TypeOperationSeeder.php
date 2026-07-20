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
                'commission' => 10
                
            ],
            [
                'nom_operation' => 'Retrait',
                'commission' => 15
            ],
            [
                'nom_operation' => 'Transfert',
                'commission' => 20
            ],
        ];

        $this->db->table('type_operation')->insertBatch($data);
    }
}

