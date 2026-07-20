<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => 'Client'],
            ['libelle' => 'Opérateur'],
        ];

        $this->db->table('role')->insertBatch($data);
    }
}