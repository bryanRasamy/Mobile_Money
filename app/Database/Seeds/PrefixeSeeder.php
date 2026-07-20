<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => '032'],
            ['libelle' => '033'],
            ['libelle' => '034'],
            ['libelle' => '037'],
            ['libelle' => '038'],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}