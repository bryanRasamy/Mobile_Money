<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperateursSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom' => 'orange',
                'mdp' => password_hash('orange', PASSWORD_DEFAULT),
                'id_role' => 2,
            ],
            [
                'nom' => 'autres',
                'mdp' => password_hash('autres', PASSWORD_DEFAULT),
                'id_role' => 2,
            ],
        ];

        $this->db->table('operateurs')->insertBatch($data);
    }
}