<?php
    $errorMsg = session()->getFlashdata('error');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Operateur — MoovPay</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>

  <div class="bg-grid" aria-hidden="true"></div>
  <div class="toast-container" id="toastContainer"></div>

  <section class="view active">
    <div class="flex flex-col items-center justify-center w-full px-6 py-12" style="min-height:100vh;">

      <a href="<?= site_url('/') ?>" class="btn-back mb-8">
        <i class="fas fa-arrow-left"></i> Retour
      </a>

      <div class="max-w-md w-full">
        <div class="text-center mb-10">
          <div class="choice-icon icon-gold" style="width:64px;height:64px;font-size:1.5rem;border-radius:20px;margin:0 auto 20px;">
            <i class="fas fa-headset"></i>
          </div>
          <h2 class="font-display font-extrabold mb-2" style="font-size:1.875rem;">Connexion Operateur</h2>
          <p class="text-muted text-sm">Acces reserve aux agents autorises</p>
        </div>

        <?php if (!empty($errorMsg)){ ?>
          <div class="info-box mb-6" style="background:rgba(224,82,82,0.08);border:1px solid rgba(224,82,82,0.2);color:var(--danger);">
            <i class="fas fa-circle-exclamation mr-2"></i><?= esc($errorMsg) ?>
          </div>
        <?php } ?>

        <form class="form-stack" method="post" action="<?= site_url('/login/operateur') ?>">
          <?= csrf_field() ?>
          <div class="input-group">
            <i class="fas fa-id-badge input-icon"></i>
            <input type="text" name="nom" class="input-field" placeholder="Nom d'utilisateur" value="<?= esc(old('nom')) ?>" required autofocus>
          </div>
          <div class="input-group">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" name="mdp" id="opPassword" class="input-field" placeholder="Mot de passe" required>
            <button type="button" onclick="togglePassword('opPassword', this)" class="pwd-toggle" aria-label="Afficher le mot de passe">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <button type="submit" class="btn-gold w-full text-center">
            <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
          </button>
        </form>
      </div>
    </div>
  </section>

  <script>
    function togglePassword(inputId, btn) {
      var input = document.getElementById(inputId);
      var icon = btn.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
      } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
      }
    }
  </script>
</body>
</html>
