<?php

namespace App\Controllers;

use App\Models\HistoriqueModel;

class HistoriqueController extends BaseController
{
    public function mesTransactions()
    {
        $user = session()->get('user');

        $idClient = $user['id'];
        $historiqueModel = new HistoriqueModel();

        return view('client/historique', [
            'idClient' => $idClient,
            'transactions' => $historiqueModel->getHistoriqueClient($idClient, 100),
            'solde' => $historiqueModel->getSolde($idClient),
        ]);
    }
}