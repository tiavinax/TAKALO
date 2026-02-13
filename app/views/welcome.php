<?php
ob_start();
?>
<style>
    /* Styles spécifiques à la page d'accueil */
    .hero-illustration {
        font-size: 8rem;
        line-height: 1;
        text-align: center;
        filter: drop-shadow(0 0 30px rgba(109, 40, 217, 0.5));
        animation: wiggle 3s ease-in-out infinite;
    }

    @keyframes wiggle {
        0%, 100% { transform: rotate(-5deg) scale(1); }
        50% { transform: rotate(5deg) scale(1.1); }
    }

    .statue-card {
        background: rgba(0,0,0,0.3);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.05);
        transition: all 0.3s ease;
    }

    .statue-card:hover {
        border-color: var(--primary-light);
        transform: translateY(-10px);
        box-shadow: 0 0 50px rgba(139, 92, 246, 0.3);
    }

    .bubble {
        position: relative;
        background: rgba(139, 92, 246, 0.2);
        border-radius: 40px 40px 40px 0;
        padding: 1.5rem;
    }

    .bubble::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 20px;
        border-width: 20px 20px 0;
        border-style: solid;
        border-color: rgba(139, 92, 246, 0.2) transparent transparent;
    }

    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .rainbow-text {
        background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #ffe66d, #ff99c8, #a0e7e5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 300% auto;
        animation: rainbow 4s linear infinite;
    }

    @keyframes rainbow {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }
</style>

<div class="container py-4">
    <!-- BANNIÈRE TOP FUN -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center p-3 rounded-4" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3);">
                <div class="d-flex align-items-center">
                    <span class="display-6 me-3">🎉</span>
                    <span class="fw-bold">✨ NOUVEAU : 1000+ objets disponibles ! ✨</span>
                </div>
                <span class="badge bg-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-lightning-charge-fill me-1"></i> EN DIRECT
                </span>
            </div>
        </div>
    </div>

    <!-- HERO SECTION - VERSION CARICATURE MAX -->
    <div class="row align-items-center min-vh-75 g-5">
        <div class="col-lg-6">
            <!-- Personnages rigolos -->
            <div class="d-flex gap-2 mb-4">
                <span class="badge bg-warning text-dark px-4 py-3 rounded-pill fs-6">
                    🤪 C'est gratuit !
                </span>
                <span class="badge bg-info px-4 py-3 rounded-pill fs-6">
                    ⚡ 3 clics max
                </span>
                <span class="badge bg-success px-4 py-3 rounded-pill fs-6">
                    🎯 100% fun
                </span>
            </div>

            <!-- Titre avec émoticônes animées -->
            <h1 class="display-1 fw-bold mb-4">
                <span class="rainbow-text">Taka🔄lo</span><br>
                <span style="font-size: 1.5em; line-height: 0.8;">🥳 takalo! 🎪</span>
            </h1>

            <!-- Bulle de dialogue -->
            <div class="bubble mb-5">
                <p class="lead fs-2 mb-0">
                    <span class="fw-bold">"Échange ton casque 🎧 contre ma guitare 🎸</span><br>
                    <span class="text-primary">... ou ton livre 📚 contre son drone 🚁 !"</span>
                </p>
                <div class="d-flex align-items-center mt-3">
                    <span class="display-6 me-2">🧑‍🎤</span>
                    <span class="fw-bold">— Tiavina, utilisateur pro</span>
                    <span class="ms-3">⭐️⭐️⭐️⭐️⭐️</span>
                </div>
            </div>

            <!-- BOUTONS EXPLOSIFS -->
            <div class="d-flex gap-4 mt-5">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>/register" class="btn btn-primary btn-lg px-5 py-4 fs-4 rounded-pill shadow-lg" 
                       style="background: linear-gradient(45deg, #ff6b6b, #4ecdc4); border: none;">
                        <span class="me-2">🚀</span>
                        C'est parti !
                        <span class="ms-2">🎯</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-outline-light btn-lg px-5 py-4 fs-4 rounded-pill border-2">
                        <span class="me-2">👀</span>
                        Je regarde d'abord
                    </a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>/mes-objets" class="btn btn-primary btn-lg px-5 py-4 fs-4 rounded-pill">
                        <span class="me-2">📦</span>
                        Mes trésors
                    </a>
                    <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-outline-light btn-lg px-5 py-4 fs-4 rounded-pill">
                        <span class="me-2">🔍</span>
                        Explorer
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- COLONNE DROITE - ILLUSTRATION FOLKLORIQUE -->
        <div class="col-lg-6">
            <div class="position-relative">
                <!-- ASCII Art géant -->
                <div class="hero-illustration floating text-center">
                    <div style="font-size: 2rem; white-space: pre; line-height: 1.2; color: #8b5cf6;">
╔══════════════════════════════╗
║     🎸    🔄    📚          ║
║    ┌─┐        ┌─┐           ║
║    │ │   ⚡    │ │           ║
║    └─┘        └─┘           ║
║     👕          💻           ║
╚══════════════════════════════╝
                    </div>
                </div>

                <!-- Cartes d'objets qui volent -->
                <div class="position-absolute top-0 start-0 mt-5 ms-5 animate-float" style="animation-delay: 0.5s;">
                    <div class="statue-card p-3 rounded-4" style="transform: rotate(-15deg);">
                        <span class="display-3">🎮</span>
                        <span class="badge bg-primary ms-2">Xbox</span>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 mb-5 me-5 animate-float" style="animation-delay: 1s;">
                    <div class="statue-card p-3 rounded-4" style="transform: rotate(10deg);">
                        <span class="display-3">📱</span>
                        <span class="badge bg-success ms-2">iPhone</span>
                    </div>
                </div>
                <div class="position-absolute top-50 start-50 animate-float" style="animation-delay: 1.5s;">
                    <div class="statue-card p-3 rounded-4">
                        <span class="display-3">🎧</span>
                        <span class="badge bg-warning ms-2">Sony</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION STATISTIQUES RIDICULES -->
    <div class="row my-6 py-5 g-4">
        <div class="col-md-3">
            <div class="statue-card text-center p-4 rounded-4">
                <span class="display-3">🔄</span>
                <h2 class="display-4 fw-bold mb-0">3,547</h2>
                <p class="text-secondary">Échanges réussis</p>
                <small class="text-muted">🥳 dont 27 aujourd'hui</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="statue-card text-center p-4 rounded-4">
                <span class="display-3">📦</span>
                <h2 class="display-4 fw-bold mb-0">1,284</h2>
                <p class="text-secondary">Objets dispo</p>
                <small class="text-muted">🎁 +12 ce matin</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="statue-card text-center p-4 rounded-4">
                <span class="display-3">🧑‍🤝‍🧑</span>
                <h2 class="display-4 fw-bold mb-0">892</h2>
                <p class="text-secondary">Membres actifs</p>
                <small class="text-muted">🤝 3 connectés</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="statue-card text-center p-4 rounded-4" style="background: linear-gradient(45deg, #ff6b6b22, #4ecdc422);">
                <span class="display-3">⚡</span>
                <h2 class="display-4 fw-bold mb-0">10s</h2>
                <p class="text-secondary">Temps d'échange</p>
                <small class="text-muted">🚀 record battu !</small>
            </div>
        </div>
    </div>

    <!-- SECTION COMMENT ÇA MARCHE - VERSION BANDE DESSINÉE -->
    <div class="row my-6 pt-5">
        <div class="col-12 text-center mb-5">
            <span class="display-1 mb-3">📖</span>
            <h2 class="display-3 fw-bold mb-3">
                <span class="rainbow-text">Le mode d'emploi</span>
            </h2>
            <p class="lead fs-2 text-secondary">(même ton grand-père comprendrait)</p>
        </div>

        <div class="col-md-4 mb-4">
            <div class="statue-card h-100 p-5 text-center rounded-5">
                <div class="position-relative">
                    <span class="display-1">1️⃣</span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 1rem;">
                        Étape 1
                    </span>
                </div>
                <div class="my-4">
                    <span class="display-3">📸</span>
                    <span class="display-3 mx-2">➕</span>
                    <span class="display-3">📝</span>
                </div>
                <h3 class="fw-bold mb-3">TU PUBLIES !</h3>
                <p class="fs-5 text-secondary">
                    Photo, titre, prix... <br>
                    <span class="badge bg-dark mt-2">⏱️ 30 secondes chrono</span>
                </p>
                <div class="mt-3 text-warning">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="statue-card h-100 p-5 text-center rounded-5" style="animation-delay: 0.2s;">
                <div class="position-relative">
                    <span class="display-1">2️⃣</span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning" style="font-size: 1rem;">
                        Étape 2
                    </span>
                </div>
                <div class="my-4">
                    <span class="display-3">👀</span>
                    <span class="display-3 mx-2">🔍</span>
                    <span class="display-3">🎯</span>
                </div>
                <h3 class="fw-bold mb-3">TU CHOPES !</h3>
                <p class="fs-5 text-secondary">
                    Trouve l'objet de tes rêves<br>
                    <span class="badge bg-dark mt-2">💝 Coup de coeur garanti</span>
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="statue-card h-100 p-5 text-center rounded-5" style="animation-delay: 0.4s;">
                <div class="position-relative">
                    <span class="display-1">3️⃣</span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" style="font-size: 1rem;">
                        Étape 3
                    </span>
                </div>
                <div class="my-4">
                    <span class="display-3">🤝</span>
                    <span class="display-3 mx-2">🔄</span>
                    <span class="display-3">🎉</span>
                </div>
                <h3 class="fw-bold mb-3">T'ÉCHANGES !</h3>
                <p class="fs-5 text-secondary">
                    Accepte, échange, kiffe<br>
                    <span class="badge bg-dark mt-2">✨ Paf ! C'est à toi</span>
                </p>
            </div>
        </div>
    </div>

    <!-- SECTION TESTIMONIALS - VERSION DINGUE -->
    <div class="row my-6 py-5">
        <div class="col-12 text-center mb-5">
            <span class="display-1 mb-3">🗣️</span>
            <h2 class="display-3 fw-bold mb-3">
                <span class="rainbow-text">Ils ont kiffé</span>
            </h2>
            <p class="lead fs-2 text-secondary">(et ils sont pas difficiles)</p>
        </div>

        <div class="col-md-4 mb-4">
            <div class="statue-card p-4 rounded-4">
                <div class="d-flex gap-2 mb-3">
                    <span class="display-3">🧔‍♂️</span>
                    <div>
                        <span class="fw-bold fs-4">Jean-Michel</span>
                        <span class="ms-2">⭐️⭐️⭐️⭐️⭐️</span>
                    </div>
                </div>
                <p class="fs-4 mb-3">
                    <span class="text-primary">"</span>
                    J'ai échangé ma vieille guitare contre un drone ! 
                    <span class="text-primary">"</span>
                </p>
                <span class="badge bg-dark">🎸 ➡️ 🚁</span>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="statue-card p-4 rounded-4">
                <div class="d-flex gap-2 mb-3">
                    <span class="display-3">🧑‍🦰</span>
                    <div>
                        <span class="fw-bold fs-4">Kevin</span>
                        <span class="ms-2">⭐️⭐️⭐️⭐️⭐️</span>
                    </div>
                </div>
                <p class="fs-4 mb-3">
                    <span class="text-primary">"</span>
                    3 clics et j'avais mon casque ! Trop facile 
                    <span class="text-primary">"</span>
                </p>
                <span class="badge bg-dark">💻 ➡️ 🎧</span>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="statue-card p-4 rounded-4">
                <div class="d-flex gap-2 mb-3">
                    <span class="display-3">👩‍🦱</span>
                    <div>
                        <span class="fw-bold fs-4">Sophie</span>
                        <span class="ms-2">⭐️⭐️⭐️⭐️⭐️</span>
                    </div>
                </div>
                <p class="fs-4 mb-3">
                    <span class="text-primary">"</span>
                    J'ai même pas eu à bouger de mon canapé ! 
                    <span class="text-primary">"</span>
                </p>
                <span class="badge bg-dark">🛋️ ➡️ 📱</span>
            </div>
        </div>
    </div>

    <!-- CALL TO ACTION FINAL - EXPLOSIF -->
    <div class="row my-6">
        <div class="col-12">
            <div class="statue-card p-5 text-center rounded-5" 
                 style="background: linear-gradient(135deg, #6d28d9, #8b5cf6); border: none;">
                <span class="display-1 mb-3">🎪</span>
                <h2 class="display-3 fw-bold mb-4 text-white">
                    Prêt à rejoindre la fête ?
                </h2>
                <p class="lead fs-1 text-white mb-5">
                    +892 personnes échangent déjà !
                </p>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>/register" class="btn btn-light btn-lg px-5 py-4 fs-3 rounded-pill shadow-lg" 
                       style="color: #6d28d9; font-weight: 800;">
                        <span class="me-2">🚀</span>
                        CRÉER MON COMPTE GRATUIT
                        <span class="ms-2">⚡</span>
                    </a>
                    <p class="mt-4 text-white-50">
                        <i class="bi bi-shield-check me-1"></i>
                        Sans engagement • 100% gratuit • Trop cool
                    </p>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-light btn-lg px-5 py-4 fs-3 rounded-pill shadow-lg">
                        <span class="me-2">🔍</span>
                        EXPLORER LE CATALOGUE
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "Accueil - Takalo-takalo", "content" => $content]);
