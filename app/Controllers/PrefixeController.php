<?php

namespace App\Controllers;

use App\Models\PrefixeModel;

class PrefixeController extends BaseController {
    public function index(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $prefixeModel = new PrefixeModel();

        $donnee = [
            'titre' => 'ajout de prefixe',
            'prefixes' => $prefixeModel->findAll()
        ];

        return view('operateur/config_prefix', $donnee);
    }

    public function ajouterPrefixe(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $libelle = $this->request->getPost('libelle');

        $prefixeModel = new PrefixeModel();

        $donnee = [
            'libelle' => $libelle
        ];

        try {
            $prefixeModel->insert($donnee);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du prefixe: ' . $e->getMessage());
        }

        return redirect()->to('/prefixe/form')->with('message', 'Le prefixe a été ajouté avec succès.');
    }

    public function supprimerPrefixe($id){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $prefixeModel = new PrefixeModel();
        $prefixe = $prefixeModel->find($id);

        if(!$prefixe){
            return redirect()->back()->withInput()->with('error', "Le prefixe n'existe pas");
        }

        try {
            $prefixeModel->delete($id);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la suppression du prefixe: ' . $e->getMessage());
        }
    }


}
