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

      public function enregistrer(?int $idClientDepart, int $idType, ?int $idClientArriver, float $montant, float $frais = 0): int
    {
        return (int) $this->insert([
            'id_client_depart'  => $idClientDepart,
            'id_type'           => $idType,
            'id_client_arriver' => $idClientArriver,
            'montant'           => $montant,
            'frais'             => $frais,
        ], true);
    }

    public function getSolde(int $idClient): float
    {
        $credit = (float) ($this->selectSum('montant')
                        ->where('id_client_arriver', $idClient)
                        ->get()->getRow()->montant ?? 0);

        $debit = (float) ($this->selectSum('montant')
                       ->where('id_client_depart', $idClient)
                       ->get()->getRow()->montant ?? 0);

        $frais = (float) ($this->selectSum('frais')
                        ->where('id_client_depart', $idClient)
                        ->get()->getRow()->frais ?? 0);

        return $credit - $debit - $frais;
    }

    public function getHistoriqueClient(int $idClient, int $limite = 20): array
    {
        return $this->select('historique.*, t.nom_operation')
                    ->join('type_operation t', 't.id = historique.id_type')
                    ->groupStart()
                        ->where('id_client_depart', $idClient)
                        ->orWhere('id_client_arriver', $idClient)
                    ->groupEnd()
                    ->orderBy('date', 'DESC')
                    ->limit($limite)
                    ->find();
    }
}
