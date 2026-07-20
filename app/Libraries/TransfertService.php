<?php
namespace App\Libraries;

use App\Models\ClientModel;
use App\Models\BaremeModel;
use App\Models\TypeOperationModel;
use App\Models\HistoriqueModel;

class TransfertService
{
    protected ClientModel $clientModel;
    protected BaremeModel $baremeModel;
    protected TypeOperationModel $typeModel;
    protected HistoriqueModel $historiqueModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->baremeModel = new BaremeModel();
        $this->typeModel = new TypeOperationModel();
        $this->historiqueModel = new HistoriqueModel();
    }

    public function calculerFrais(int $idClientDepart, int $idClientArriver, float $montant): array
    {
        $clientDepart = $this->clientModel->find($idClientDepart);
        $clientArriver = $this->clientModel->find($idClientArriver);

        if (!$clientDepart || !$clientArriver) {
            throw new \RuntimeException('Client introuvable.');
        }

        $memeOperateur = (int) $clientDepart['id_operateur'] === (int) $clientArriver['id_operateur'];

        $idType = $this->typeModel->getIdByNom('Transfert');

        if (!$idType) {
            throw new \RuntimeException("Type 'Transfert' introuvable.");
        }

        return [
            'id_type' => $idType,
            'meme_operateur' => $memeOperateur,
            'frais_total' => $this->baremeModel->getFrais($idType, $montant),
        ];
    }

    public function transfererAvecRepartition(int $idClientDepart, array $telephones, float $montantTotal): array
    {
        $telephones = array_values(array_unique(array_filter($telephones, fn($t) => trim($t) !== '')));
        $nombre = count($telephones);

        if ($nombre === 0) {
            return ['success' => false, 'message' => 'Aucun beneficiaire fourni.'];
        }

        if ($montantTotal <= 0) {
            return ['success' => false, 'message' => 'Montant invalide.'];
        }

        $montantBase = floor($montantTotal / $nombre);
        $reste = $montantTotal - ($montantBase * $nombre);

        $destinataires = [];
        foreach ($telephones as $i => $telephone) {
            $montantLigne = $montantBase + ($i < $reste ? 1 : 0);
            $destinataires[] = ['telephone' => $telephone, 'montant' => $montantLigne];
        }

        return $this->transfererMultiple($idClientDepart, $destinataires);
    }
    /**
     * $destinataires = [['telephone' => '...', 'montant' => 1000], ...]
     */
    public function transfererMultiple(int $idClientDepart, array $destinataires): array
    {
        $db = \Config\Database::connect();

        $lignes = [];
        $totalAPreleve = 0.0;

        foreach ($destinataires as $i => $dest) {
            $telephone = trim($dest['telephone'] ?? '');
            $montant = (float) ($dest['montant'] ?? 0);

            if ($telephone === '' || $montant <= 0) {
                return ['success' => false, 'message' => 'Ligne ' . ($i + 1) . ' invalide.'];
            }

            $destinataire = $this->clientModel->where('telephone', $telephone)->first();

            if (!$destinataire) {
                return ['success' => false, 'message' => "Beneficiaire introuvable : {$telephone}"];
            }

            if ((int) $destinataire['id'] === $idClientDepart) {
                return ['success' => false, 'message' => 'Transfert vers vous-meme impossible.'];
            }

            $details = $this->calculerFrais($idClientDepart, (int) $destinataire['id'], $montant);
            $totalAPreleve += $montant + $details['frais_total'];

            $lignes[] = [
                'id_client_arriver' => (int) $destinataire['id'],
                'montant' => $montant,
                'details' => $details,
            ];
        }

        $solde = $this->historiqueModel->getSolde($idClientDepart);

        if ($solde < $totalAPreleve) {
            return ['success' => false, 'message' => "Solde insuffisant pour l'ensemble des transferts."];
        }

        $db->transStart();

        foreach ($lignes as $ligne) {
            $d = $ligne['details'];
            $this->historiqueModel->enregistrer(
                $idClientDepart,
                $d['id_type'],
                $ligne['id_client_arriver'],
                $ligne['montant'],
                $d['frais_total']
            );
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return ['success' => false, 'message' => "Erreur lors de l'enregistrement des transferts."];
        }

        return [
            'success' => true,
            'message' => count($lignes) . ' transfert(s) effectue(s) avec succes.',
            'solde' => $this->historiqueModel->getSolde($idClientDepart),
        ];
    }
}