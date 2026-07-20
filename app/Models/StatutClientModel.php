<?php
namespace App\Models;

use CodeIgniter\Model;

class StatutClientModel extends Model {
    protected $table      = 'statut_client';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'libelle'
    ];

    protected $validationRules = [
        'libelle' => 'required|max_length[50]',
    ];

    protected $validationMessages = [
        'libelle' => [
            'required' => 'Le libelle est obligatoire.',
            'max_length' => 'Le libelle ne doit pas depasser 50 caracteres.',
        ],
    ];
}
