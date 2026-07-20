<?php
namespace App\Models;

use CodeIgniter\Model;

class HistoriqueModel extends Model {
    protected $table      = 'historique';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'id_client_depart',
        'id_type',
        'id_client_arriver',
        'montant',
        'frais',
        'date'
    ];

    protected $validationRules = [
        'id_client_depart' => 'required|integer|is_not_unique[clients.id]',
        'id_type' => 'required|integer|is_not_unique[type_operation.id]',
        'id_client_arriver' => 'required|integer|is_not_unique[clients.id]',
        'montant' => 'required|decimal',
        'frais' => 'permit_empty|decimal',
    ];

    protected $validationMessages = [
        'id_client_depart' => [
            'required' => 'Le client de depart est obligatoire.',
            'integer' => 'Le client de depart doit etre un entier.',
            'is_not_unique' => 'Le client de depart selectionne est invalide.',
        ],
        'id_type' => [
            'required' => 'Le type d operation est obligatoire.',
            'integer' => 'Le type d operation doit etre un entier.',
            'is_not_unique' => 'Le type d operation selectionne est invalide.',
        ],
        'id_client_arriver' => [
            'required' => 'Le client d arrivee est obligatoire.',
            'integer' => 'Le client d arrivee doit etre un entier.',
            'is_not_unique' => 'Le client d arrivee selectionne est invalide.',
        ],
        'montant' => [
            'required' => 'Le montant est obligatoire.',
            'decimal' => 'Le montant doit etre un nombre decimal.',
        ],
        'frais' => [
            'decimal' => 'Les frais doivent etre un nombre decimal.',
        ],
    ];
}
