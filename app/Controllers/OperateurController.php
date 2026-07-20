<?php

namespace App\Controllers;

use App\Models\OperateurModel;

class OperateurController extends BaseController {
    public function index(){
        return view('operateur/login_operateur');
    }

    public function login(){
        $operateurModel = new OperateurModel();

        $nom = $this->request->getPost('nom');
        $mot_de_passe = $this->request->getPost('mdp');

        if (empty($nom) || empty($mot_de_passe)) {
            $errorMsg = 'Nom et mot de passe requis.';
            
            return redirect()->back()->withInput()->with('error', $errorMsg);
        }

        $operateur = $operateurModel->where('nom', $nom)->first();

        $isPasswordValid = false;
        if ($operateur) {
            if (password_verify($mot_de_passe, $operateur['mdp'])) {
                $isPasswordValid = true;
            } else if ($mot_de_passe === $operateur['mdp']) {
                $isPasswordValid = true;
            }
        }

        if ($isPasswordValid) {
            session()->set('user', [
                'id'   => $operateur['id'],
                'nom'  => $operateur['nom'],
                'role' => $operateur['id_role']
            ]);

            return redirect()->to('/operateur/prefixe/form');
        }

        $errorMsg = 'Nom ou mot de passe incorrect.';

        return redirect()->to('/loginOperateur')->with('error', $errorMsg);
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/')->with('message', 'Déconnexion réussie.');
    }

}
