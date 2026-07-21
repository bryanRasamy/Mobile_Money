<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\PrefixeModel;

class ClientController extends BaseController {
    public function index(){
        return view('client/index');
    }

    public function login(){
        $telephone = trim($this->request->getPost('telephone'));

        if (empty($telephone)) {
            return redirect()->back()->withInput()->with('error', 'Numéro de téléphone requis.');
        }

        $prefixeTelephone = mb_substr($telephone, 0, 3, 'UTF-8');
        $prefixeModel = new PrefixeModel();

        $prefixe = $prefixeModel->where("libelle",$prefixeTelephone)->first();

        if(!$prefixe){
            return redirect()->back()->withInput()->with('error', 'Prefixe invalide');
        }

        $clientModel = new ClientModel();
        $client = $clientModel->findOrCreateByTelephone($telephone,$prefixe['id_operateur']);

        session()->set('user', [
            'id' => $client['id'],
            'telephone' => $client['telephone'],
            'role' => $client['id_role'],
        ]);

        return redirect()->to(site_url('client/dashboard'));
    }

    public function dashboard(){
        $historiqueModel = new \App\Models\HistoriqueModel();
        $user = session()->get('user');
        $idClient = $user['id'];

        return view('client/dashboard', [
            'idClient' => $idClient,
            'telephone' => $user['telephone'],
            'solde' => $historiqueModel->getSolde($idClient),
            'transactions' => $historiqueModel->getHistoriqueClient($idClient, 6),
        ]);
    }
}
