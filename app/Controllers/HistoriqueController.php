<?php

namespace App\Controllers;

use App\Models\HistoriqueModel;

class HistoriqueController extends BaseController
{
    public function mesTransactions()
    {
        $idClient = session()->get('id_client');
        $historiqueModel = new HistoriqueModel();

        return view('client/historique', [
            'idClient'     => $idClient,
            'transactions' => $historiqueModel->getHistoriqueClient($idClient, 100),
            'solde'        => $historiqueModel->getSolde($idClient),
        ]);
    }
}