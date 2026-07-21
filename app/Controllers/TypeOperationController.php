<?php

namespace App\Controllers;

use App\Models\BaremeModel;
use App\Models\TypeOperationModel;

class TypeOperationController extends BaseController {
    public function index(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $donnee = [
            'titre' => "ajout d'un type d'operation",
        ];

        return view('operateur/types_operation', $donnee);
    }

    public function ajouterTypeOperation(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $nomOperation = $this->request->getPost('nom_operation');
        $commission = $this->request->getPost('commission');
        $promotion = $this->request->getPost('promotion');
        $baremes = $this->request->getPost('baremes');

        if(!$baremes || empty($baremes)){
            return redirect()->back()->withInput()->with('error', 'Les baremes sont obligatoires');
        }

        $baremeModele = new BaremeModel();
        $typeOperationModel = new TypeOperationModel();

        $donnee = [
            'nom_operation' => $nomOperation,
            'commission' => $commission,
            'promotion' => $promotion
        ];

        try {
            $typeOperationModel->insert($donnee);
            $idType = $typeOperationModel->getInsertID();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du type d\'opération: ' . $e->getMessage());
        }

        foreach ($baremes as &$bareme) {
            $bareme['id_type'] = $idType;
        }

        try {
            $baremeModele->ajouterBaremes($baremes);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout des baremes: ' . $e->getMessage());
        }
        

        return redirect()->back()->withInput()->with('message', 'Le type d\'opération a été ajouté avec succès.');
    }
}
