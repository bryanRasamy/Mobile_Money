<?= $this->include('partials/head_client') ?>

<section class="view active" id="viewClientDashboard">
  <div class="flex flex-col w-full" style="min-height:100vh;">

    <header class="header-main">
      <div class="header-logo">
        <div class="header-logo-icon"><i class="fas fa-wallet"></i></div>
        <span class="header-logo-text">Moov<span>Pay</span></span>
      </div>
      <div class="header-actions">
        <a href="<?= site_url('operateur/logout') ?>" class="btn-text-icon hide-mobile">
    <i class="fas fa-right-from-bracket"></i>
    <span>Deconnexion</span>
</a>
      </div>
    </header>

    <main class="flex-1 px-6 py-8 max-w-4xl w-full" style="margin-left:auto;margin-right:auto;padding-bottom:96px;">

      <div class="mb-8">
        <p class="text-sm text-muted mb-1">Bonjour,</p>
        <h2 class="font-display font-extrabold" style="font-size:1.5rem;"><?= esc($telephone) ?></h2>
      </div>

      <div class="balance-card mb-8">
        <div class="flex items-center justify-between mb-6">
          <span class="text-sm" style="opacity:0.8;">Solde disponible</span>
          <span class="text-xs font-bold" style="background:rgba(255,255,255,0.15);padding:4px 12px;border-radius:20px;">Compte Principal</span>
        </div>
        <div class="mb-6">
          <span class="font-display font-black" style="font-size:2.25rem;" id="soldeValue"><?= number_format($solde, 0, ',', ' ') ?></span>
          <span class="ml-1" style="font-size:1.125rem;opacity:0.8;">FCFA</span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-sm" style="opacity:0.7;"><i class="fas fa-phone mr-1"></i><?= esc($telephone) ?></span>
        </div>
      </div>

      <div class="grid-4 mb-10">
        <button class="quick-action" onclick="openModal('modalDepot')">
          <div class="quick-action-icon qa-icon-blue"><i class="fas fa-plus-circle"></i></div>
          <span class="text-xs font-bold text-muted">Deposer</span>
        </button>
        <button class="quick-action" onclick="openModal('modalRetrait')">
          <div class="quick-action-icon qa-icon-gold"><i class="fas fa-money-bill-wave"></i></div>
          <span class="text-xs font-bold text-muted">Retirer</span>
        </button>
        <button class="quick-action" onclick="openModal('modalTransfer')">
          <div class="quick-action-icon qa-icon-accent"><i class="fas fa-paper-plane"></i></div>
          <span class="text-xs font-bold text-muted">Transferer</span>
        </button>
        <a href="<?= site_url('client/historique') ?>" class="quick-action">
          <div class="quick-action-icon qa-icon-pink"><i class="fas fa-clock-rotate-left"></i></div>
          <span class="text-xs font-bold text-muted">Historique</span>
        </a>
      </div>

      <div class="card">
        <div class="flex items-center justify-between mb-5">
          <h3 class="font-display font-bold" style="font-size:1.125rem;">Transactions récentes</h3>
          <a href="<?= site_url('client/historique') ?>" class="link-accent">Voir tout</a>
        </div>

        <?php if (empty($transactions)) : ?>
          <p class="text-muted text-sm">Aucune transaction pour le moment.</p>
        <?php endif; ?>

        <?php foreach ($transactions as $tx) :
            $estCredit = $tx['id_client_arriver'] == $idClient;
        ?>
          <div class="tx-row">
            <div class="tx-icon <?= $estCredit ? 'tx-icon-credit' : 'tx-icon-debit' ?>">
              <i class="fas <?= $estCredit ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
            </div>
            <div class="tx-info">
              <p class="tx-info-title"><?= esc($tx['nom_operation']) ?></p>
              <p class="tx-info-date"><?= esc(date('Y-m-d H:i', strtotime($tx['date']))) ?></p>
            </div>
            <div class="tx-amount">
              <p class="tx-amount-value <?= $estCredit ? 'tx-amount-credit' : 'tx-amount-debit' ?>">
                <?= $estCredit ? '+' : '-' ?> <?= number_format($tx['montant'], 0, ',', ' ') ?> FCFA
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </main>

    <nav class="mobile-nav" aria-label="Navigation principale">
      <button class="mobile-nav-item active"><i class="fas fa-house"></i><span>Accueil</span></button>
      <button class="mobile-nav-item" onclick="openModal('modalTransfer')"><i class="fas fa-paper-plane"></i><span>Transferer</span></button>
      <a href="<?= site_url('client/historique') ?>" class="mobile-nav-item"><i class="fas fa-clock-rotate-left"></i><span>Historique</span></a>
    </nav>
  </div>
</section>

<!-- MODAL : Dépôt -->
<div class="modal-overlay" id="modalDepot" onclick="closeModalOverlay(event)">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between mb-6">
      <h3 class="font-display font-bold" style="font-size:1.25rem;">Déposer de l'argent</h3>
      <button class="modal-close" onclick="closeModal('modalDepot')" aria-label="Fermer"><i class="fas fa-xmark"></i></button>
    </div>
    <form class="form-stack" action="<?= site_url('client/depot') ?>" onsubmit="handleDepot(event)">
      <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-input">
      <div class="input-group">
        <i class="fas fa-money-bill input-icon"></i>
        <input type="number" name="montant" class="input-field" placeholder="Montant (FCFA)" min="100" required>
      </div>
      <div class="info-box info-box-accent">
        <i class="fas fa-info-circle mr-2"></i>Dépôt gratuit, crédité instantanément.
      </div>
      <button type="submit" class="btn-primary w-full text-center">
        <i class="fas fa-plus-circle mr-2"></i>Confirmer le dépôt
      </button>
    </form>
  </div>
</div>

<!-- MODAL : Retrait -->
<div class="modal-overlay" id="modalRetrait" onclick="closeModalOverlay(event)">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between mb-6">
      <h3 class="font-display font-bold" style="font-size:1.25rem;">Retrait d'argent</h3>
      <button class="modal-close" onclick="closeModal('modalRetrait')" aria-label="Fermer"><i class="fas fa-xmark"></i></button>
    </div>
    <form class="form-stack" action="<?= site_url('client/retrait') ?>" onsubmit="handleRetrait(event)">
      <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-input">
      <div class="input-group">
        <i class="fas fa-money-bill input-icon"></i>
        <input type="number" name="montant" class="input-field" placeholder="Montant (FCFA)" min="500" required>
      </div>
      <div class="info-box info-box-gold">
        <i class="fas fa-info-circle mr-2"></i>Frais selon barème en vigueur.
      </div>
      <button type="submit" class="btn-primary w-full text-center">
        <i class="fas fa-money-bill-wave mr-2"></i>Confirmer le retrait
      </button>
    </form>
  </div>
</div>

<!-- MODAL : Transfert -->
<div class="modal-overlay" id="modalTransfer" onclick="closeModalOverlay(event)">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between mb-6">
      <h3 class="font-display font-bold" style="font-size:1.25rem;">Transferer de l'argent</h3>
      <button class="modal-close" onclick="closeModal('modalTransfer')" aria-label="Fermer"><i class="fas fa-xmark"></i></button>
    </div>
    <form class="form-stack" action="<?= site_url('client/transfert') ?>" onsubmit="handleTransfer(event)">
      <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-input">
      <div class="input-group">
        <i class="fas fa-phone input-icon"></i>
        <input type="tel" name="telephone" class="input-field" placeholder="Numero du beneficiaire" required>
      </div>
      <div class="input-group">
        <i class="fas fa-money-bill input-icon"></i>
        <input type="number" name="montant" class="input-field" placeholder="Montant (FCFA)" min="100" required>
      </div>
      <div class="info-box info-box-gold">
        <i class="fas fa-info-circle mr-2"></i>Frais selon barème en vigueur.
      </div>
      <button type="submit" class="btn-primary w-full text-center">
        <i class="fas fa-paper-plane mr-2"></i>Envoyer
      </button>
    </form>
  </div>
</div>

<script src="<?= base_url('js/client.js') ?>"></script>

