<?= $this->extend('operateur/modele') ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="font-display font-extrabold" style="font-size:1.5rem;">Configuration des prefixes</h2>
        <p class="text-sm text-muted">Gerez les prefixes telephoniques reconnus par la plateforme</p>
    </div>
</div>

<div class="grid-2" style="align-items:start;">

    <!-- Formulaire d'ajout -->
    <div class="card">
        <h3 class="font-display font-bold mb-6" style="font-size:1.125rem;">Ajouter un prefixe</h3>
        <form class="form-stack" method="post" action="<?= site_url('operateur/prefixe/add') ?>">
            <?= csrf_field() ?>
            <div class="input-group">
                <i class="fas fa-hashtag input-icon"></i>
                <input type="text" name="libelle" class="input-field" placeholder="Ex: 034, 038" maxlength="20" value="<?= esc(old('libelle')) ?>" required>
            </div>
            <button type="submit" class="btn-primary w-full text-center">
                <i class="fas fa-plus mr-2"></i>Ajouter un prefixe
            </button>
        </form>
    </div>

    <!-- Tableau des prefixes -->
    <div class="card overflow-x-auto">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-display font-bold" style="font-size:1.125rem;">Prefixes enregistres</h3>
            <span class="text-sm font-bold text-accent"><?= count($prefixes ?? []) ?> prefixe(s)</span>
        </div>

        <?php if (empty($prefixes)) { ?>
            <p class="text-muted text-sm">Aucun prefixe enregistre pour le moment.</p>
        <?php } else { ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Prefixe</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prefixes as $prefixe) { ?>
                        <tr>
                            <td class="font-bold"><?= esc($prefixe['libelle']) ?></td>
                            <td style="text-align:right;">
                                <a href="<?= site_url('operateur/prefixe/delete/' . $prefixe['id']) ?>" class="btn-icon" title="Supprimer" onclick="return confirm('Supprimer le prefixe « <?= esc($prefixe['libelle'], 'js') ?> » ?');">
                                    <i class="fas fa-trash" style="color:var(--danger);"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

</div>

<?= $this->endSection() ?>