<?php
namespace App\Models;

use CodeIgniter\Model;

class VueHistoriqueTypeOperationClientModel extends Model {
    protected $table      = 'v_historique_type_operation_client';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'nom_operation',
        'id_client_depart',
        'id_type',
        'id_client_arriver',
        'montant',
        'frais',
        'date',
        'telephone',
        'id_operateur',
        'id_role',
        'id_statut'
    ];

    public function getTotalParTypePourOperateur($idOperateur){
        return $this->select('nom_operation, SUM(frais) as total_frais')
                    ->where('id_operateur', $idOperateur)
                    ->groupBy('nom_operation')
                    ->findAll();
    }
}