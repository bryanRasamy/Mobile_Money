<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model {
    protected $table      = 'clients';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'telephone',
        'id_role',
        'id_statut'
    ];

    protected $validationRules = [
        'telephone' => 'required|max_length[20]|is_unique[clients.telephone,id,{id}]',
        'id_role' => 'required|integer|is_not_unique[role.id]',
        'id_statut' => 'required|integer|is_not_unique[statut_client.id]',
    ];

    protected $validationMessages = [
        'telephone' => [
            'required' => 'Le telephone est obligatoire.',
            'max_length' => 'Le telephone ne doit pas depasser 20 caracteres.',
            'is_unique' => 'Ce numero de telephone est deja utilise.',
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

    public function findOrCreateByTelephone(string $telephone): array
    {
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
