<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model {
    protected $table      = 'clients';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'telephone',
        'id_operateur',
        'id_role',
        'id_statut'
    ];

    protected $validationRules = [
        'telephone' => 'required|max_length[20]|is_unique[clients.telephone,id,{id}]',
        'id_operateur' => 'required|integer|is_not_unique[operateurs.id]',
        'id_role' => 'required|integer|is_not_unique[role.id]',
        'id_statut' => 'required|integer|is_not_unique[statut_client.id]',
    ];

    protected $validationMessages = [
        'telephone' => [
            'required' => 'Le telephone est obligatoire.',
            'max_length' => 'Le telephone ne doit pas depasser 20 caracteres.',
            'is_unique' => 'Ce numero de telephone est deja utilise.',
        ],
        'id_operateur' => [
            'required' => 'L\'operateur est obligatoire.',
            'integer' => 'L\'operateur doit etre un entier.',
            'is_not_unique' => 'L\'operateur selectionne est invalide.',
        ],
        'id_role' => [
            'required' => 'Le role est obligatoire.',
            'integer' => 'Le role doit etre un entier.',
            'is_not_unique' => 'Le role selectionne est invalide.',
        ],
        'id_statut' => [
            'required' => 'Le statut est obligatoire.',
            'integer' => 'Le statut doit etre un entier.',
            'is_not_unique' => 'Le statut selectionne est invalide.',
        ],
    ];

    public function getSituationParClient($idOperateur){
        return $this->select("
                clients.id AS id_client,
                telephone,
                statut_client.libelle AS statut,
                COUNT(historique.id) AS nombre_transactions,
                SUM(historique.montant) AS total_montant,
                SUM(CASE WHEN historique.id_client_depart = clients.id THEN historique.frais ELSE 0 END) AS total_frais
            ", false)
            ->join('statut_client', 'statut_client.id = clients.id_statut', 'left')
            ->join('historique', 'historique.id_client_depart = clients.id OR historique.id_client_arriver = clients.id', 'left')
            ->where('clients.id_operateur', $idOperateur)
            ->groupBy('clients.id')
            ->findAll();
    }

    public function findOrCreateByTelephone($telephone,$idOperateur){
        $client = $this->where('telephone', $telephone)->first();

        if ($client) {
            return $client;
        }

        $id = $this->insert([
            'telephone' => $telephone,
            'id_role'   => $this->defaultRoleId,
            'id_statut' => $this->defaultStatutId,
        ], true);

        return $this->find($id);
    }

}
