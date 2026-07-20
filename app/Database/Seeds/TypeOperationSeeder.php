<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeOperationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nom_operation' => 'Dépôt'],
            ['nom_operation' => 'Retrait'],
            ['nom_operation' => 'Transfert'],
        ];

        $this->db->table('type_operation')->insertBatch($data);
    }
}

