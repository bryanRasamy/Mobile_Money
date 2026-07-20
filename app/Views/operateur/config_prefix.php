<?php
    $successMsg = session()->getFlashdata('message');
    $errorMsg   = session()->getFlashdata('error');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($titre ?? 'Configuration prefixe') ?> — MoovPay</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>

  <div class="bg-grid" aria-hidden="true"></div>
  <div class="toast-container" id="toastContainer"></div>

  <div class="flex w-full" style="min-height:100vh;">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="flex items-center gap-3 px-6 mb-8">
        <div class="header-logo-icon" style="background:linear-gradient(135deg,var(--gold),var(--gold-light));color:var(--bg);">
          <i class="fas fa-wallet"></i>
        </div>
        <div>
          <span class="font-display font-extrabold block" style="font-size:1.125rem;line-height:1.2;">
            Moov<span class="text-gold">Pay</span>
          </span>
          <span class="text-xs text-muted">Espace Operateur</span>
        </div>
      </div>
      <hr class="sidebar-divider">
      <nav aria-label="Menu operateur">
        <a href="<?= site_url('operateur/prefixe/form') ?>" class="sidebar-link active">
          <i class="fas fa-hashtag"></i> Prefixes
        </a>
        <a href="#" class="sidebar-link">
          <i class="fas fa-list-ol"></i> Types d'operation
        </a>
        <a href="#" class="sidebar-link">
          <i class="fas fa-chart-line"></i> Situation des gains
        </a>
      </nav>
      <div class="sidebar-logout">
        <button onclick="document.getElementById('logoutForm').submit()" class="btn-logout">
          <i class="fas fa-right-from-bracket"></i> Deconnexion
        </button>
      </div>
    </aside>

    <!-- Contenu principal -->
    <main class="op-main">

      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="font-display font-extrabold" style="font-size:1.5rem;">Configuration des prefixes</h2>
          <p class="text-sm text-muted">Gerez les prefixes telephoniques reconnus par la plateforme</p>
        </div>
      </div>

      <?php if (!empty($successMsg)): ?>
        <div class="info-box info-box-accent mb-6">
          <i class="fas fa-circle-check mr-2"></i><?= esc($successMsg) ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($errorMsg)): ?>
        <div class="info-box mb-6" style="background:rgba(224,82,82,0.08);border:1px solid rgba(224,82,82,0.2);color:var(--danger);">
          <i class="fas fa-circle-exclamation mr-2"></i><?= esc($errorMsg) ?>
        </div>
      <?php endif; ?>

      <div class="grid-2" style="align-items:start;">

        <!-- Formulaire d'ajout -->
        <div class="card">
          <h3 class="font-display font-bold mb-6" style="font-size:1.125rem;">Ajouter un prefixe</h3>
          <form class="form-stack" method="post" action="<?= site_url('operateur/prefixe/add') ?>">
            <?= csrf_field() ?>
            <div class="input-group">
              <i class="fas fa-hashtag input-icon"></i>
              <input
                type="text"
                name="libelle"
                class="input-field"
                placeholder="Ex: 034, 038"
                maxlength="20"
                value="<?= esc(old('libelle')) ?>"
                required
              >
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

          <?php if (empty($prefixes)): ?>
            <p class="text-muted text-sm">Aucun prefixe enregistre pour le moment.</p>
          <?php else: ?>
            <table class="data-table">
              <thead>
                <tr>
                  <th>Prefixe</th>
                  <th style="text-align:right;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($prefixes as $prefixe): ?>
                  <tr>
                    <td class="font-bold"><?= esc($prefixe['libelle']) ?></td>
                    <td style="text-align:right;">
                      <button
                        type="button"
                        class="btn-icon"
                        title="Modifier (bientot disponible)"
                        disabled
                        style="opacity:0.4;cursor:not-allowed;"
                      >
                        <i class="fas fa-pen"></i>
                      </button>
                      <a
                        href="<?= site_url('operateur/prefixe/delete/' . $prefixe['id']) ?>"
                        class="btn-icon"
                        title="Supprimer"
                        onclick="return confirm('Supprimer le prefixe « <?= esc($prefixe['libelle'], 'js') ?> » ?');"
                      >
                        <i class="fas fa-trash" style="color:var(--danger);"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>

      </div>
    </main>
  </div>

  <form id="logoutForm" method="post" action="<?= site_url('logout') ?>" class="hidden">
    <?= csrf_field() ?>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php if (!empty($successMsg)): ?>
        showToast(<?= json_encode($successMsg) ?>, 'success');
      <?php endif; ?>
      <?php if (!empty($errorMsg)): ?>
        showToast(<?= json_encode($errorMsg) ?>, 'error');
      <?php endif; ?>
    });

    function showToast(message, type) {
      type = type || 'success';
      var container = document.getElementById('toastContainer');
      var toast = document.createElement('div');
      toast.className = 'toast';
      var iconClass = 'toast-icon-' + type;
      var iconName = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';
      toast.innerHTML = '<i class="fas ' + iconName + ' ' + iconClass + '"></i><span>' + message + '</span>';
      container.appendChild(toast);
      setTimeout(function () {
        toast.classList.add('leaving');
        setTimeout(function () { toast.remove(); }, 300);
      }, 3500);
    }
  </script>
</body>
</html>
