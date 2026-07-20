<?php
namespace App\Models;

use CodeIgniter\Model;

class VueHistoriqueTypeOperationModel extends Model {
    protected $table      = 'v_historique_type_operation';
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
        'date'
    ];

}
