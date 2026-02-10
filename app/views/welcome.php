<?php
ob_start();
?>
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
                </div>
            </div>
        </div>
    </div>
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
            </div>
        </div>
    </div>
</div>

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
