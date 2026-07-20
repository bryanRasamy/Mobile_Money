<?= $this->extend('operateur/modele') ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="font-display font-extrabold" style="font-size:1.5rem;">Situation des gains</h2>
        <p class="text-sm text-muted">Total des frais perçus, par type d'opération</p>
    </div>
</div>

<?php if (empty($situations)) { ?>

    <div class="card">
        <p class="text-muted text-sm">Aucune donnee disponible pour le moment.</p>
    </div>

<?php } else {

    $totalGeneral = 0;
    foreach ($situations as $situation) {
        $totalGeneral += (float) ($situation['total_frais'] ?? 0);
    }

    $iconColors = ['accent', 'gold', 'blue', 'danger'];
?>

    <!-- Carte du total general -->
    <div class="card mb-8" style="background:linear-gradient(135deg, rgba(13,155,106,0.12), rgba(212,168,67,0.08)); border-color:var(--accent);">
        <div class="flex items-center gap-3 mb-3">
            <div class="stat-icon stat-icon-accent"><i class="fas fa-sack-dollar"></i></div>
            <span class="text-sm text-muted">Total general des gains</span>
        </div>
        <p class="font-display font-extrabold" style="font-size:2rem;"><?= number_format($totalGeneral, 0, ',', ' ') ?> Ar</p>
    </div>

    <!-- Cards par type d'operation -->
    <div class="grid-stats">
        <?php foreach ($situations as $index => $situation) {
            $nom        = $situation['nom_operation'] ?? '—';
            $total      = (float) ($situation['total_frais'] ?? 0);
            $colorClass = $iconColors[$index % count($iconColors)];
            $lower      = mb_strtolower($nom);

            if (strpos($lower, 'depot') !== false || strpos($lower, 'dépot') !== false) {
                $icon = 'fa-arrow-down';
            } elseif (strpos($lower, 'retrait') !== false) {
                $icon = 'fa-arrow-up';
            } elseif (strpos($lower, 'transfert') !== false) {
                $icon = 'fa-right-left';
            } else {
                $icon = 'fa-coins';
            }
        ?>
            <div class="stat-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="stat-icon stat-icon-<?= $colorClass ?>"><i class="fas <?= $icon ?>"></i></div>
                    <span class="text-sm text-muted"><?= esc($nom) ?></span>
                </div>
                <p class="font-display font-extrabold" style="font-size:1.5rem;"><?= number_format($total, 0, ',', ' ') ?> Ar</p>
                <p class="text-xs mt-4 text-muted">Total des frais perçus</p>
            </div>
        <?php } ?>
    </div>

<?php } ?>

<?= $this->endSection() ?>
