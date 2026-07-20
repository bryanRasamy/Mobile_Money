<?php

namespace App\Controllers;

use App\Models\HistoriqueModel;

class HistoriqueController extends BaseController {
    public function index(){

       $donnee = [
            'titre'      => 'Situation des gains',
            'situations' => [
                ['nom_operation' => 'Depot',     'total_frais' => 1250000],
                ['nom_operation' => 'Retrait',   'total_frais' => 820000],
                ['nom_operation' => 'Transfert', 'total_frais' => 430000],
                ['nom_operation' => 'Test', 'total_frais' => 430000],
                ['nom_operation' => 'Test 2', 'total_frais' => 430000],
            ],
        ];

        return view('operateur/situation_gain', $donnee);
    }
}
