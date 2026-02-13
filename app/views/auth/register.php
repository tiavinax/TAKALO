<?php
ob_start();
?>
<style>
    .auth-card-fun {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 40px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .auth-card-fun::before {
        content: "🎉";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 10rem;
        opacity: 0.05;
        transform: rotate(10deg);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="auth-card-fun">
                <div class="text-center mb-5">
                    <span class="display-2 mb-3 d-inline-block animate-float">🎊</span>
                    <h1 class="display-3 fw-bold mb-3 rainbow-text">
                        REJOINS L'AVENTURE !
                    </h1>
                    <p class="fs-3 text-secondary">
                        Inscris-toi en 30 secondes chrono
                    </p>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger p-4 rounded-4 fs-4 mb-4">
                        <span class="me-2">😅</span> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo BASE_URL; ?>/register">
                    <div class="mb-3">
                        <label class="form-label fs-4 mb-2">
                            <span class="me-2">🧑</span> Nom complet
                        </label>
                        <input type="text" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               name="nom" value="<?php echo htmlspecialchars($old_nom ?? ''); ?>" 
                               placeholder="Jean Dupont" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fs-4 mb-2">
                            <span class="me-2">📧</span> Email
                        </label>
                        <input type="email" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               name="email" value="<?php echo htmlspecialchars($old_email ?? ''); ?>" 
                               placeholder="exemple@email.com" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fs-4 mb-2">
                            <span class="me-2">🔒</span> Mot de passe
                        </label>
                        <input type="password" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               name="password" placeholder="••••••••" required>
                        <div class="form-text text-secondary fs-5 mt-2">
                            💡 Minimum 6 caractères
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label class="form-label fs-4 mb-2">
                            <span class="me-2">✅</span> Confirmation
                        </label>
                        <input type="password" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               name="confirm_password" placeholder="••••••••" required>
                    </div>
                    
                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-success btn-lg py-4 fs-2 rounded-pill"
                                style="background: linear-gradient(45deg, #10b981, #059669);">
                            <span class="me-2">🚀</span>
                            CRÉER MON COMPTE
                        </button>
                        
                        <div class="text-center mt-4">
                            <p class="fs-4 text-secondary">
                                Déjà inscrit ? 
                                <a href="<?php echo BASE_URL; ?>/login" class="text-decoration-none fw-bold">
                                    Se connecter <span class="ms-1">🔐</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Bénéfices -->
            <div class="row mt-5 g-3">
                <div class="col-4 text-center">
                    <div class="bg-dark bg-opacity-25 p-3 rounded-4">
                        <span class="display-5">🆓</span>
                        <p class="mt-2 fw-bold">Gratuit</p>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div class="bg-dark bg-opacity-25 p-3 rounded-4">
                        <span class="display-5">⚡</span>
                        <p class="mt-2 fw-bold">Rapide</p>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div class="bg-dark bg-opacity-25 p-3 rounded-4">
                        <span class="display-5">🔒</span>
                        <p class="mt-2 fw-bold">Sécurisé</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "🎊 Inscription - Takalo-takalo", "content" => $content]);
?>
