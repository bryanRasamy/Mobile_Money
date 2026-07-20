<?= $this->extend('operateur/modele') ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="font-display font-extrabold" style="font-size:1.5rem;">Situation des clients</h2>
        <p class="text-sm text-muted">Detail des operations par client</p>
    </div>
</div>

<?php if (empty($situations)) { ?>

    <div class="card">
        <p class="text-muted text-sm">Aucune donnee disponible pour le moment.</p>
    </div>

<?php } else {

    $totalMontantGeneral = 0;
    $totalFraisGeneral   = 0;
    foreach ($situations as $situation) {
        $totalMontantGeneral += (float) ($situation['total_montant'] ?? 0);
        $totalFraisGeneral   += (float) ($situation['total_frais'] ?? 0);
    }
?>

    <!-- Cards de synthese -->
    <div class="grid-stats mb-8">
        <div class="stat-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="stat-icon stat-icon-blue"><i class="fas fa-users"></i></div>
                <span class="text-sm text-muted">Clients actifs</span>
            </div>
            <p class="font-display font-extrabold" style="font-size:1.5rem;"><?= count($situations) ?></p>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="stat-icon stat-icon-accent"><i class="fas fa-money-bill-transfer"></i></div>
                <span class="text-sm text-muted">Montant total transités</span>
            </div>
            <p class="font-display font-extrabold" style="font-size:1.5rem;"><?= number_format($totalMontantGeneral, 0, ',', ' ') ?> Ar</p>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="stat-icon stat-icon-gold"><i class="fas fa-sack-dollar"></i></div>
                <span class="text-sm text-muted">Frais total générés</span>
            </div>
            <p class="font-display font-extrabold" style="font-size:1.5rem;"><?= number_format($totalFraisGeneral, 0, ',', ' ') ?> Ar</p>
        </div>
    </div>

    <!-- Tableau detaille par client -->
    <div class="card overflow-x-auto">
        <h3 class="font-display font-bold mb-6" style="font-size:1.125rem;">Detail par client</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Transactions</th>
                    <th>Montant transité</th>
                    <th style="text-align:right;">Frais generes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($situations as $situation) {
                    $telephone   = $situation['telephone'] ?? '—';
                    $statut      = $situation['statut'] ?? null;
                    $nbTransac   = $situation['nombre_transactions'] ?? 0;
                    $totalMontant = (float) ($situation['total_montant'] ?? 0);
                    $totalFrais   = (float) ($situation['total_frais'] ?? 0);
                ?>
                    <tr>
                        <td class="font-bold"><?= esc($telephone) ?></td>
                        <td>
                            <?php if ($statut !== null) { ?>
                                <span class="badge <?= (mb_strtolower($statut) === 'actif') ? 'badge-success' : 'badge-fail' ?>">
                                    <?= esc($statut) ?>
                                </span>
                            <?php } else { ?>
                                <span class="text-muted">—</span>
                            <?php } ?>
                        </td>
                        <td><?= (int) $nbTransac ?></td>
                        <td><?= number_format($totalMontant, 0, ',', ' ') ?> Ar</td>
                        <td style="text-align:right;" class="font-bold text-accent"><?= number_format($totalFrais, 0, ',', ' ') ?> Ar</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php } ?>

<?= $this->endSection() ?>
