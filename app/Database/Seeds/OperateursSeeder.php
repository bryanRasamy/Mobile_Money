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
                'nom' => 'jean',
                'mdp' => password_hash('jean123', PASSWORD_DEFAULT),
                'id_role' => 2,
            ],
        ];

        $this->db->table('operateurs')->insertBatch($data);
    }
}