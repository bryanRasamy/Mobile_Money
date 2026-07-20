<?php
    $errorMsg = session()->getFlashdata('error');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoovPay — Mobile Money</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>

  <div class="bg-grid" aria-hidden="true"></div>
  <div id="particles" aria-hidden="true"></div>
  <div class="toast-container" id="toastContainer"></div>

  <section class="view active">
    <div class="flex flex-col items-center justify-center w-full px-6 py-12" style="min-height:100vh;">

      <!-- Logo -->
      <div class="text-center mb-12">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="choice-icon icon-accent" style="width:56px;height:56px;font-size:1.5rem;border-radius:16px;">
            <i class="fas fa-wallet"></i>
          </div>
          <h1 class="font-display font-black text-muted" style="font-size:2.5rem;letter-spacing:-0.02em;">
            Moov<span class="text-accent">Pay</span>
          </h1>
        </div>
        <p class="text-lg text-muted">Votre argent, votre liberte, partout.</p>
      </div>

      <?php if (!empty($errorMsg)){ ?>
        <div class="info-box mb-8 max-w-2xl w-full" style="background:rgba(224,82,82,0.08);border:1px solid rgba(224,82,82,0.2);color:var(--danger);">
          <i class="fas fa-circle-exclamation mr-2"></i><?= esc($errorMsg) ?>
        </div>
      <?php } ?>

      <div class="grid-2 max-w-2xl w-full">
        <a href="<?= site_url('client/login') ?>" class="choice-card client-card" role="button" aria-label="Connexion client">
          <div class="choice-icon icon-accent"><i class="fas fa-mobile-screen-button"></i></div>
          <h2 class="font-display font-bold mb-2" style="font-size:1.25rem;">Espace Client</h2>
          <p class="text-muted text-sm">Accedez a votre compte avec votre numero de telephone</p>
          <div class="mt-6 flex items-center justify-center gap-2 text-sm font-bold text-accent">
            Se connecter <i class="fas fa-arrow-right text-xs"></i>
          </div>
        </a>

        <a href="<?= site_url('loginOperateur') ?>" class="choice-card operateur-card" role="button" aria-label="Connexion operateur">
          <div class="choice-icon icon-gold"><i class="fas fa-headset"></i></div>
          <h2 class="font-display font-bold mb-2" style="font-size:1.25rem;">Espace Operateur</h2>
          <p class="text-muted text-sm">Connexion securisee avec vos identifiants agent</p>
          <div class="mt-6 flex items-center justify-center gap-2 text-sm font-extrabold text-gold">
            Se connecter <i class="fas fa-arrow-right text-xs"></i>
          </div>
        </a>
      </div>

      <p class="mt-16 text-xs text-muted">&copy; <?= date('Y') ?> MoovPay — Tous droits reserves</p>
    </div>
  </section>

  <script>
    (function () {
      var container = document.getElementById('particles');
      var colors = ['rgba(13,155,106,0.4)', 'rgba(212,168,67,0.3)', 'rgba(18,201,138,0.3)'];
      for (var i = 0; i < 20; i++) {
        var p = document.createElement('div');
        p.className = 'particle';
        var size = Math.random() * 4 + 2;
        p.style.width = size + 'px';
        p.style.height = size + 'px';
        p.style.left = Math.random() * 100 + '%';
        p.style.background = colors[Math.floor(Math.random() * colors.length)];
        p.style.animationDuration = (Math.random() * 15 + 10) + 's';
        p.style.animationDelay = (Math.random() * 10) + 's';
        container.appendChild(p);
      }
    })();

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      var particles = document.querySelectorAll('.particle');
      for (var p = 0; p < particles.length; p++) { particles[p].style.animationPlayState = 'paused'; }
      document.querySelector('.bg-grid').style.animationPlayState = 'paused';
    }
  </script>
</body>
</html>
