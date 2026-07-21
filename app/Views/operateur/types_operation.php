<?= $this->extend('operateur/modele') ?>

<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="font-display font-extrabold" style="font-size:1.5rem;">Types d'operation</h2>
        <p class="text-sm text-muted">Definissez les types d'operation et leurs baremes de frais</p>
    </div>
</div>

<div class="card" style="max-width:640px;">
    <h3 class="font-display font-bold mb-6" style="font-size:1.125rem;">Ajouter un type d'operation</h3>

    <form class="form-stack" method="post" action="<?= site_url('operateur/typeOperation/add') ?>" id="typeOperationForm">
        <?= csrf_field() ?>

        <div class="input-group">
            <i class="fas fa-tag input-icon"></i>
            <input type="text" name="nom_operation" class="input-field" placeholder="Nom de l'operation (ex: Depot, Retrait, Transfert)" value="<?= esc(old('nom_operation')) ?>" required>
        </div>

        <div class="input-group">
            <i class="fas fa-tag input-icon"></i>
            <input type="text" name="commission" class="input-field" placeholder="Commission (%)" value="<?= esc(old('commission')) ?>" required>
        </div>

        <div class="input-group">
            <i class="fas fa-tag input-icon"></i>
            <input type="text" name="promotion" class="input-field" placeholder="Promotion (%)" value="<?= esc(old('promotion')) ?>" required>
        </div>

        <div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-bold text-muted">Baremes de frais</span>
                <button type="button" id="addBareme" class="btn-icon" title="Ajouter une ligne de bareme" style="color:var(--accent);">
                    <i class="fas fa-circle-plus" style="font-size:1.4rem;"></i>
                </button>
            </div>

            <div id="baremesContainer"></div>

            <p id="noBaremeMsg" class="text-muted text-sm">Aucun bareme ajoute. Cliquez sur + pour en ajouter un.</p>
        </div>

        <button type="submit" class="btn-primary w-full text-center">
            <i class="fas fa-check mr-2"></i>Enregistrer le type d'operation
        </button>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    (function () {
        var container = document.getElementById('baremesContainer');
        var noMsg     = document.getElementById('noBaremeMsg');
        var addBtn    = document.getElementById('addBareme');
        var form      = document.getElementById('typeOperationForm');
        var index     = 0;

        function toggleNoMsg() {
            noMsg.style.display = container.children.length === 0 ? 'block' : 'none';
        }

        function addRow() {
            var i = index++;
            var row = document.createElement('div');
            row.className = 'flex items-center gap-3 mb-3 bareme-row';
            row.innerHTML =
                '<div class="input-group flex-1">' +
                    '<input type="number" step="0.01" name="baremes[' + i + '][valeur_min]" class="input-field" style="padding-left:16px;" placeholder="Valeur min" required>' +
                '</div>' +
                '<div class="input-group flex-1">' +
                    '<input type="number" step="0.01" name="baremes[' + i + '][valeur_max]" class="input-field" style="padding-left:16px;" placeholder="Valeur max" required>' +
                '</div>' +
                '<div class="input-group flex-1">' +
                    '<input type="number" step="0.01" name="baremes[' + i + '][montant]" class="input-field" style="padding-left:16px;" placeholder="Montant" required>' +
                '</div>' +
                '<button type="button" class="btn-icon remove-bareme" title="Supprimer cette ligne" style="color:var(--danger);">' +
                    '<i class="fas fa-circle-minus" style="font-size:1.4rem;"></i>' +
                '</button>';
            container.appendChild(row);
            toggleNoMsg();
        }

        addBtn.addEventListener('click', addRow);

        container.addEventListener('click', function (e) {
            var btn = e.target.closest('.remove-bareme');
            if (btn) {
                btn.closest('.bareme-row').remove();
                toggleNoMsg();
            }
        });

        form.addEventListener('submit', function (e) {
            if (container.children.length === 0) {
                e.preventDefault();
                alert('Ajoutez au moins un bareme avant d\'enregistrer.');
            }
        });

        toggleNoMsg();
    })();
</script>
<?= $this->endSection() ?>
