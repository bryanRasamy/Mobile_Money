<?php

namespace App\Controllers;

use App\Models\TypeOperationModel;

class TypeOperationController extends BaseController {
    public function index(){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $donnee = [
            'titre' => 'ajout de prefixe',
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

        $typeOperationModel = new TypeOperationModel();

        $donnee = [
            'nom_operation' => $nomOperation
        ];

        try {
            $typeOperationModel->insert($donnee);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du type d\'opération: ' . $e->getMessage());
        }

        $baremeController = new BaremeController();
        $baremes = $this->request->getPost('baremes');

        $baremeController->ajouterBaremes($baremes);

        return redirect()->to('/typeOperation/form')->with('message', 'Le type d\'opération a été ajouté avec succès.');
    }
}
