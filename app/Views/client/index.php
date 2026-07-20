<?= $this->include('partials/head_client') ?>

<section class="view active" id="viewClientLogin">
    <div class="flex flex-col items-center justify-center w-full px-6 py-12" style="min-height:100vh;">

        <a href="<?= site_url('/') ?>" class="btn-back mb-8">
            <i class="fas fa-arrow-left"></i> Retour
        </a>

        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <div class="choice-icon icon-accent" style="width:64px;height:64px;font-size:1.5rem;border-radius:20px;margin:0 auto 20px;">
                    <i class="fas fa-mobile-screen-button"></i>
                </div>
                <h2 class="font-display font-extrabold mb-2" style="font-size:1.875rem;">Connexion Client</h2>
                <p class="text-muted text-sm">Entrez votre numéro pour accéder à votre compte</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <p class="text-center text-sm mb-4" style="color:#e53e3e;">
                    <?= esc(session()->getFlashdata('error')) ?>
                </p>
            <?php endif; ?>

            <form class="form-stack" method="post" action="<?= site_url('/loginClient') ?>">
                <?= csrf_field() ?>
                <div class="input-group">
                    <i class="fas fa-phone input-icon"></i>
                    <input type="tel" id="clientPhone" name="telephone" class="input-field"
                           placeholder="Ex: 038 XX XXX XX" required autocomplete="tel" maxlength="10"
                           value="<?= esc(old('telephone')) ?>">
                </div>
                <button type="submit" class="btn-primary w-full text-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                </button>
            </form>
        </div>
    </div>
</section>
