<?= $this->include('partials/head') ?>

<section class="view active" id="viewLanding">
    <div class="flex flex-col items-center justify-center w-full px-6 py-12" style="min-height:100vh;">

        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="choice-icon icon-accent" style="width:56px;height:56px;font-size:1.5rem;border-radius:16px;">
                    <i class="fas fa-wallet"></i>
                </div>
                <h1 class="font-display font-black text-muted" style="font-size:2.5rem;letter-spacing:-0.02em;">
                    Moov<span class="text-accent">Pay</span>
                </h1>
            </div>
            <p class="text-lg text-muted">Votre argent, votre liberté, partout.</p>
        </div>

        <div class="grid-2 max-w-2xl w-full">
            <a href="<?= site_url('loginClient') ?>" class="choice-card client-card" aria-label="Connexion client">
                <div class="choice-icon icon-accent"><i class="fas fa-mobile-screen-button"></i></div>
                <h2 class="font-display font-bold mb-2" style="font-size:1.25rem;">Espace Client</h2>
                <p class="text-muted text-sm">Accédez à votre compte avec votre numéro de téléphone</p>
                <div class="mt-6 flex items-center justify-center gap-2 text-sm font-bold text-accent">
                    Se connecter <i class="fas fa-arrow-right text-xs"></i>
                </div>
            </a>

            <a href="<?= site_url('operateur') ?>" class="choice-card operateur-card" aria-label="Connexion opérateur">
                <div class="choice-icon icon-gold"><i class="fas fa-headset"></i></div>
                <h2 class="font-display font-bold mb-2" style="font-size:1.25rem;">Espace Opérateur</h2>
                <p class="text-muted text-sm">Connexion sécurisée avec vos identifiants agent</p>
                <div class="mt-6 flex items-center justify-center gap-2 text-sm font-extrabold text-gold">
                    Se connecter <i class="fas fa-arrow-right text-xs"></i>
                </div>
            </a>
        </div>

        <p class="mt-16 text-xs text-muted">&copy; 2025 MoovPay — Tous droits réservés</p>
    </div>
</section>

