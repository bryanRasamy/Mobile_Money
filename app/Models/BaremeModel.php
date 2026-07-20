<?php
namespace App\Models;

use CodeIgniter\Model;

class BaremeModel extends Model {
    protected $table      = 'baremes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_type',
        'valeur_min',
        'valeur_max',
        'montant'
    ];

    protected $validationRules = [
        'id_type' => 'required|integer|is_not_unique[type_operation.id]',
        'valeur_min' => 'required|decimal',
        'valeur_max' => 'required|decimal',
        'montant' => 'required|decimal',
    ];

    protected $validationMessages = [
        'id_type' => [
            'required' => 'Le type d operation est obligatoire.',
            'integer' => 'Le type d operation doit etre un entier.',
            'is_not_unique' => 'Le type d operation selectionne est invalide.',
        ],
        'valeur_min' => [
            'required' => 'La valeur minimale est obligatoire.',
            'decimal' => 'La valeur minimale doit etre un nombre decimal.',
        ],
        'valeur_max' => [
            'required' => 'La valeur maximale est obligatoire.',
            'decimal' => 'La valeur maximale doit etre un nombre decimal.',
        ],
        'montant' => [
            'required' => 'Le montant est obligatoire.',
            'decimal' => 'Le montant doit etre un nombre decimal.',
        ],
    ];

    public function ajouterBaremes($baremes){
        try {
            foreach ($baremes as $bareme) {
               $this->insert($bareme);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
