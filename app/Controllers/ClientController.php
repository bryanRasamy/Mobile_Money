<?php

namespace App\Controllers;

use App\Models\ClientModel;

class ClientController extends BaseController
{
    public function index()
    {
        return view('client/index');
    }

    public function login()
    {
        $telephone = trim($this->request->getPost('telephone'));

        if (empty($telephone)) {
            return redirect()->back()->withInput()->with('error', 'Numéro de téléphone requis.');
        }

        $clientModel = new ClientModel();
        $client = $clientModel->findOrCreateByTelephone($telephone);

        session()->set('user', [
            'id' => $client['id'],
            'telephone' => $client['telephone'],
            'role' => $client['id_role'],
        ]);

        return redirect()->to(site_url('client/dashboard'));
    }

    public function dashboard()
    {
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

    public function depot()
    {
        $montant = (float) $this->request->getPost('montant');
        $user = session()->get('user');
        $idClient = $user['id'];

        if ($montant <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Montant invalide.']);
        }

        $typeModel = new \App\Models\TypeOperationModel();
        $idType = $typeModel->getIdByNom('Dépôt');

        if (!$idType) {
            return $this->response->setJSON(['success' => false, 'message' => "Type 'Depot' introuvable."]);
        }

        $historiqueModel = new \App\Models\HistoriqueModel();
        $historiqueModel->enregistrer(null, $idType, $idClient, $montant, 0);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Dépôt effectué avec succès.',
            'solde' => $historiqueModel->getSolde($idClient),
            'csrf_hash' => csrf_hash(),
        ]);
    }

    public function retrait()
    {
        $montant = (float) $this->request->getPost('montant');
        $user = session()->get('user');
        $idClient = $user['id'];

        if ($montant <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Montant invalide.']);
        }

        $historiqueModel = new \App\Models\HistoriqueModel();
        $solde = $historiqueModel->getSolde($idClient);

        $typeModel = new \App\Models\TypeOperationModel();
        $idType = $typeModel->getIdByNom('Retrait');

        if (!$idType) {
            return $this->response->setJSON(['success' => false, 'message' => "Type 'Retrait' introuvable."]);
        }

        $baremeModel = new \App\Models\BaremeModel();
        $frais = $baremeModel->getFrais($idType, $montant);

        if ($solde < ($montant + $frais)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Solde insuffisant.']);
        }

        $historiqueModel->enregistrer($idClient, $idType, null, $montant, $frais);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Retrait effectué avec succès.',
            'solde' => $historiqueModel->getSolde($idClient),
            'csrf_hash' => csrf_hash(),
        ]);
    }

    public function transfert()
    {
        $user = session()->get('user');
        $idClient = $user['id'] ?? null;

        if (!$idClient) {
            return $this->response->setJSON(['success' => false, 'message' => 'Session expiree.']);
        }

        $destinataires = $this->request->getPost('destinataires');

        if (!is_array($destinataires) || count($destinataires) === 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Aucun beneficiaire fourni.']);
        }

        $service = new \App\Libraries\TransfertService();

        try {
            $resultat = $service->transfererMultiple($idClient, $destinataires);
        } catch (\RuntimeException $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }

        $resultat['csrf_hash'] = csrf_hash();
        return $this->response->setJSON($resultat);
    }
}