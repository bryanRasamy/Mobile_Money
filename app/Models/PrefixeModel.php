<?php
namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model {
    protected $table      = 'prefixe';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'libelle'
    ];

    protected $validationRules = [
        'libelle' => 'required|max_length[20]',
    ];

    protected $validationMessages = [
        'libelle' => [
            'required' => 'Le libelle est obligatoire.',
            'max_length' => 'Le libelle ne doit pas depasser 20 caracteres.',
        ],
    ];
}
