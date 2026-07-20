<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('RoleSeeder');
        $this->call('StatutClientSeeder');
        $this->call('PrefixeSeeder');
        $this->call('TypeOperationSeeder');
        $this->call('ClientsSeeder');
        $this->call('OperateursSeeder');
        $this->call('BaremesSeeder');
        $this->call('HistoriqueSeeder');
    }
}