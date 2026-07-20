<?php

namespace App\Controllers;

use App\Models\BaremeModel;

class BaremeController extends BaseController {
    public function ajouterBaremes($baremes){
        $user = session()->get('user');

        if (!$user || !isset($user['id'])) {
            $errorMsg = 'Session expirée. Veuillez vous reconnecter.';

            return redirect()->to('/')->with('error', $errorMsg);
        }

        $baremeModel = new BaremeModel();

        try {
            foreach ($baremes as $bareme) {
               $baremeModel->insert($bareme);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout des baremes: ' . $e->getMessage());
        }
    }
}
