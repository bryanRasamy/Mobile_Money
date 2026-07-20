<?php
namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model {
    protected $table      = 'type_operation';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nom_operation'
    ];

    protected $validationRules = [
        'nom_operation' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'nom_operation' => [
            'required' => 'Le nom de l operation est obligatoire.',
            'max_length' => 'Le nom de l operation ne doit pas depasser 100 caracteres.',
        ],
    ];
}
