<?php
namespace App\Models;

use CodeIgniter\Model;

class OperateurModel extends Model {
    protected $table      = 'operateurs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nom',
        'mdp',
        'id_role'
    ];

    protected $validationRules = [
        'nom' => 'required|max_length[100]',
        'mdp' => 'required|min_length[6]',
        'id_role' => 'required|integer|is_not_unique[role.id]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire.',
            'max_length' => 'Le nom ne doit pas depasser 100 caracteres.',
        ],
        'mdp' => [
            'required' => 'Le mot de passe est obligatoire.',
            'min_length' => 'Le mot de passe doit contenir au moins 6 caracteres.',
        ],
        'id_role' => [
            'required' => 'Le role est obligatoire.',
            'integer' => 'Le role doit etre un entier.',
            'is_not_unique' => 'Le role selectionne est invalide.',
        ],
    ];
}
