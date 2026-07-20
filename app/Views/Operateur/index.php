<?= $this->include('partials/head_operateur') ?>

<section class="view active" id="viewOperateurLogin">
    <div class="flex flex-col items-center justify-center w-full px-6 py-12" style="min-height:100vh;">

        <a href="<?= site_url('/') ?>" class="btn-back mb-8">
            <i class="fas fa-arrow-left"></i> Retour
        </a>

        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <div class="choice-icon icon-gold" style="width:64px;height:64px;font-size:1.5rem;border-radius:20px;margin:0 auto 20px;">
                    <i class="fas fa-headset"></i>
                </div>
                <h2 class="font-display font-extrabold mb-2" style="font-size:1.875rem;">Connexion Opérateur</h2>
                <p class="text-muted text-sm">Accès réservé aux agents autorisés</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <p class="text-center text-sm mb-4" style="color:#e53e3e;">
                    <?= esc(session()->getFlashdata('error')) ?>
                </p>
            <?php endif; ?>

            <form class="form-stack" method="post" action="<?= site_url('operateur/login') ?>">
                <?= csrf_field() ?>
                <div class="input-group">
                    <i class="fas fa-id-badge input-icon"></i>
                    <input type="text" id="opNom" name="nom" class="input-field"
                           placeholder="Nom" required value="<?= esc(old('nom')) ?>">
                </div>
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="opPassword" name="mdp" class="input-field"
                           placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn-gold w-full text-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                </button>
            </form>

            <p class="text-center mt-6 text-xs text-muted">
                <i class="fas fa-shield-halved mr-1"></i>Connexion sécurisée et tracée
            </p>
        </div>
    </div>
</section>
