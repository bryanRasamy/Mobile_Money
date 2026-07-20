<?php
    $successMsg = session()->getFlashdata('message');
    $errorMsg   = session()->getFlashdata('error');
    $currentUrl = current_url();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($titre ?? 'MoovPay') ?> — MoovPay</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
  <?= $this->renderSection('styles') ?>
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
        <a href="<?= site_url('operateur/prefixe/form') ?>" class="sidebar-link <?= (strpos($currentUrl, 'prefixe') !== false) ? 'active' : '' ?>">
          <i class="fas fa-hashtag"></i> Prefixes
        </a>
        <a href="<?= site_url('operateur/types_operation') ?>" class="sidebar-link <?= (strpos($currentUrl, 'types_operation') !== false) ? 'active' : '' ?>">
          <i class="fas fa-list-ol"></i> Types d'operation
        </a>
        <a href="<?= site_url('operateur/situation_gain') ?>" class="sidebar-link <?= (strpos($currentUrl, 'situation_gain') !== false) ? 'active' : '' ?>">
          <i class="fas fa-chart-line"></i> Situation des gains
        </a>
      </nav>
      <div class="sidebar-logout">
        <a href="<?= site_url('logout') ?>" class="btn-logout">
          <i class="fas fa-right-from-bracket"></i> Deconnexion
        </a>
      </div>
    </aside>

    <!-- Contenu principal -->
    <main class="op-main">

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

      <?= $this->renderSection('content') ?>

    </main>
  </div>

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

  <?= $this->renderSection('scripts') ?>
</body>
</html>
