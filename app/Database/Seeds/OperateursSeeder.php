<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperateursSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom' => 'admin',
                'mdp' => password_hash('admin123', PASSWORD_DEFAULT),
                'id_role' => 2,
            ],
            [
                'nom' => 'operateur',
                'mdp' => password_hash('operateur123', PASSWORD_DEFAULT),
                'id_role' => 3,
            ],
        ];

        $this->db->table('operateurs')->insertBatch($data);
    }
}