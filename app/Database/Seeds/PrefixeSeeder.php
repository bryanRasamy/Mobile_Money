<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'libelle' => '032',
                'id_operateur' => 1
            ],
            [
                'libelle' => '033',
                'id_operateur' => 2
            ],
            [
                'libelle' => '034',
                'id_operateur' => 2
                
            ],
            [
                'libelle' => '037',
                'id_operateur' => 1
            ],
            [
                'libelle' => '038',
                'id_operateur' => 2
            ],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}