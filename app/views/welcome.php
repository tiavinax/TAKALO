<?php
ob_start();
?>
<<<<<<< HEAD
<!-- Hero Section -->
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">
                Échangez ce que vous n'utilisez plus 
                <span class="gradient-text">contre ce dont vous avez besoin</span>
            </h1>
            <p class="lead mb-4">
                Takalo-takalo est la plateforme idéale pour donner une seconde vie à vos objets 
                et découvrir de nouveaux trésors sans dépenser d'argent.
            </p>
            <div class="d-flex gap-3">
                <a href="<?php echo BASE_URL; ?>/register" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-person-plus me-2"></i> Commencer maintenant
                </a>
                <a href="#how-it-works" class="btn btn-outline-primary btn-lg px-4">
                    <i class="bi bi-play-circle me-2"></i> Comment ça marche
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                     class="img-fluid rounded-3 shadow-lg floating-element" 
                     alt="Échange d'objets">
                <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white rounded-circle p-3 shadow">
                    <i class="bi bi-arrow-left-right fs-4"></i>
                </div>
                <div class="position-absolute top-100 start-100 translate-middle bg-success text-white rounded-circle p-3 shadow">
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="container py-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <i class="bi bi-people display-4 text-primary mb-3"></i>
                    <h2 class="fw-bold">500+</h2>
                    <p class="text-muted">Utilisateurs actifs</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <i class="bi bi-box display-4 text-success mb-3"></i>
                    <h2 class="fw-bold">1,200+</h2>
                    <p class="text-muted">Objets échangés</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <i class="bi bi-star display-4 text-warning mb-3"></i>
                    <h2 class="fw-bold">98%</h2>
                    <p class="text-muted">Satisfaction des utilisateurs</p>
=======
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
>>>>>>> b-tiavina1
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>

<!-- Comment ça marche -->
<div id="how-it-works" class="container py-5">
    <h2 class="text-center fw-bold mb-5">Comment ça marche ?</h2>
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-person-plus fs-3"></i>
                </div>
                <h5 class="fw-bold">1. Inscription</h5>
                <p class="text-muted">Créez votre compte gratuitement en 2 minutes</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-icon bg-success bg-opacity-10 text-success rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-box fs-3"></i>
                </div>
                <h5 class="fw-bold">2. Ajoutez vos objets</h5>
                <p class="text-muted">Publiez les objets que vous souhaitez échanger</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-icon bg-info bg-opacity-10 text-info rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-search fs-3"></i>
                </div>
                <h5 class="fw-bold">3. Parcourez le catalogue</h5>
                <p class="text-muted">Découvrez les objets proposés par d'autres utilisateurs</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-icon bg-warning bg-opacity-10 text-warning rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-arrow-left-right fs-3"></i>
                </div>
                <h5 class="fw-bold">4. Échangez</h5>
                <p class="text-muted">Proposez un échange et recevez votre nouvel objet</p>
            </div>
        </div>
    </div>
</div>

<!-- Objets populaires -->
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Objets récemment ajoutés</h2>
        <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-outline-primary">
            Voir tout <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="row">
        <!-- Ces objets seront chargés dynamiquement en temps réel -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         class="card-img-top" alt="Chaussures de sport">
                    <span class="position-absolute top-0 end-0 m-3 badge bg-primary">Nouveau</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Chaussures de sport Nike</h5>
                    <p class="card-text text-muted">Taille 42, état quasi neuf</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">45 €</span>
                        <button class="btn btn-sm btn-outline-primary">Voir détails</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         class="card-img-top" alt="Appareil photo">
                    <span class="position-absolute top-0 end-0 m-3 badge bg-success">Populaire</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Appareil photo vintage</h5>
                    <p class="card-text text-muted">Appareil photo reflex argentique</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">120 €</span>
                        <button class="btn btn-sm btn-outline-primary">Voir détails</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         class="card-img-top" alt="Smartphone">
                    <span class="position-absolute top-0 end-0 m-3 badge bg-warning">En tendance</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">iPhone 12 Pro</h5>
                    <p class="card-text text-muted">256 Go, écran parfait, avec coque</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">600 €</span>
                        <button class="btn btn-sm btn-outline-primary">Voir détails</button>
                    </div>
                </div>
=======

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
>>>>>>> b-tiavina1
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<!-- Témoignages -->
<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Ce que disent nos utilisateurs</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card testimonial-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" 
                             class="rounded-circle me-3" width="50" height="50" alt="Utilisateur">
                        <div>
                            <h6 class="mb-0">Sophie Martin</h6>
                            <small class="text-muted">Membre depuis 2023</small>
                        </div>
                    </div>
                    <p class="card-text">
                        "J'ai échangé mon ancienne guitare contre un super appareil photo. 
                        Tout s'est passé à merveille !"
                    </p>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card testimonial-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" 
                             class="rounded-circle me-3" width="50" height="50" alt="Utilisateur">
                        <div>
                            <h6 class="mb-0">Thomas Dubois</h6>
                            <small class="text-muted">Membre depuis 2022</small>
                        </div>
                    </div>
                    <p class="card-text">
                        "10 échanges réalisés ! Une plateforme fiable et une communauté sympa. 
                        Je recommande !"
                    </p>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card testimonial-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/67.jpg" 
                             class="rounded-circle me-3" width="50" height="50" alt="Utilisateur">
                        <div>
                            <h6 class="mb-0">Marie Laurent</h6>
                            <small class="text-muted">Membre depuis 2024</small>
                        </div>
                    </div>
                    <p class="card-text">
                        "Parfait pour se débarrasser de ce qu'on n'utilise plus et trouver 
                        des trésors gratuitement."
                    </p>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Final -->
<div class="container py-5">
    <div class="card bg-gradient-primary text-white border-0">
        <div class="card-body p-5 text-center">
            <h2 class="display-6 fw-bold mb-4">Prêt à commencer à échanger ?</h2>
            <p class="lead mb-4 opacity-75">
                Rejoignez notre communauté de plus de 500 membres actifs
            </p>
            <a href="<?php echo BASE_URL; ?>/register" class="btn btn-light btn-lg px-5">
                <i class="bi bi-rocket-takeoff me-2"></i> S'inscrire gratuitement
            </a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "Takalo-takalo - Échangez vos objets", "content" => $content]);
=======
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "Accueil - Takalo-takalo", "content" => $content]);
>>>>>>> b-tiavina1
