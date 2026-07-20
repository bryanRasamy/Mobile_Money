<?php

namespace App\Controllers;

use App\Models\HistoriqueModel;
use App\Models\VueHistoriqueTypeOperationClientModel;
use App\Models\ClientModel;

class HistoriqueController extends BaseController {
    public function index(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $vueModel = new VueHistoriqueTypeOperationClientModel();

        $situations = $vueModel->getTotalParTypePourOperateur($user['id']);

        $donnee = [
            'titre'      => 'Situation des gains',
            'situations' => $situations,
        ];

        return view('operateur/situation_gain', $donnee);
    }

    public function afficherCompteClient(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $clientModel = new ClientModel();

        $situations = $clientModel->getSituationParClient($user['id']);

        $donnee = [
            'titre'      => 'Situation des clients',
            'situations' => $situations
        ];

        return view('operateur/situations_clients', $donnee);
    }
}
