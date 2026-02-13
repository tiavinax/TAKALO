<?php
ob_start();
?>
<div class="text-center py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Hero section -->
            <div class="mb-5 animate-slide-in">
                <h1 class="display-2 fw-bold mb-4">
                    Échangez, <span class="text-gradient-animated">Partagez</span>, <span class="text-gradient-animated">Gagnez</span>
                </h1>
                <p class="lead fs-4 mb-4 text-muted">
                    La plateforme d'échange d'objets entre particuliers. 
                    Donnez une seconde vie à vos objets et découvrez des trésors.
                </p>
                <div class="d-flex gap-3 justify-content-center mt-5">
                    <a href="<?php echo BASE_URL; ?>/register" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="bi bi-rocket-takeoff me-2"></i>Commencer
                    </a>
                    <a href="#features" class="btn btn-outline-primary btn-lg px-5 py-3">
                        <i class="bi bi-info-circle me-2"></i>Découvrir
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="row mb-5 animate-slide-in" style="animation-delay: 0.2s">
                <div class="col-md-4">
                    <div class="card border-0 glass-effect">
                        <div class="card-body py-4">
                            <h2 class="display-4 fw-bold text-gradient">150+</h2>
                            <p class="text-muted mb-0">Objets disponibles</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 glass-effect">
                        <div class="card-body py-4">
                            <h2 class="display-4 fw-bold text-gradient">50+</h2>
                            <p class="text-muted mb-0">Échanges réussis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 glass-effect">
                        <div class="card-body py-4">
                            <h2 class="display-4 fw-bold text-gradient">100%</h2>
                            <p class="text-muted mb-0">Gratuit</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Features -->
            <div id="features" class="mb-5 pt-5 animate-slide-in" style="animation-delay: 0.4s">
                <h2 class="mb-5 text-center">Comment ça marche ?</h2>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 glass-effect card-glow">
                            <div class="card-body text-center p-4">
                                <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-4" 
                                     style="width: 80px; height: 80px;">
                                    <i class="bi bi-upload fs-2 text-white"></i>
                                </div>
                                <h4 class="card-title mb-3">Publiez</h4>
                                <p class="card-text text-muted">
                                    Mettez en ligne vos objets avec des photos de qualité et une description détaillée.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 glass-effect card-glow">
                            <div class="card-body text-center p-4">
                                <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-4" 
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--accent), var(--success)) !important;">
                                    <i class="bi bi-compass fs-2 text-white"></i>
                                </div>
                                <h4 class="card-title mb-3">Explorez</h4>
                                <p class="card-text text-muted">
                                    Parcourez le catalogue, filtrez par catégories et trouvez les objets qui vous intéressent.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 glass-effect card-glow">
                            <div class="card-body text-center p-4">
                                <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-4" 
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--warning), var(--danger)) !important;">
                                    <i class="bi bi-hand-thumbs-up fs-2 text-white"></i>
                                </div>
                                <h4 class="card-title mb-3">Échangez</h4>
                                <p class="card-text text-muted">
                                    Proposez des échanges et finalisez vos transactions en toute sécurité.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA Final -->
            <div class="mt-5 animate-slide-in" style="animation-delay: 0.6s">
                <div class="card border-0 glass-effect card-glow">
                    <div class="card-body p-5">
                        <h3 class="mb-3">Prêt à commencer ?</h3>
                        <p class="text-muted mb-4">Rejoignez notre communauté d'échangeurs aujourd'hui.</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="<?php echo BASE_URL; ?>/register" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-person-plus me-2"></i>S'inscrire gratuitement
                            </a>
                            <a href="<?php echo BASE_URL; ?>/login" class="btn btn-outline-primary btn-lg px-5">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "Accueil - Takalo-takalo", "content" => $content]);
