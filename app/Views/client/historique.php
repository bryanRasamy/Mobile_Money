<?= $this->include('partials/head_client') ?>

<section class="view active" id="viewHistorique">
  <div class="flex flex-col w-full px-6 py-8 max-w-4xl" style="min-height:100vh;margin:0 auto;">
    <a href="<?= site_url('client/dashboard') ?>" class="btn-back mb-8">
      <i class="fas fa-arrow-left"></i> Retour
    </a>

    <h2 class="font-display font-extrabold mb-6" style="font-size:1.5rem;">Historique complet</h2>

    <div class="card">
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
  </div>
</section>
