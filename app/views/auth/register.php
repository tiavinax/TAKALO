<?php
ob_start();
?>
<<<<<<< HEAD
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Inscription à Takalo-takalo</h4>
                </div>
                <div class="card-body">
                    <!-- Message d'erreur/succès -->
                    <div id="message" class="alert d-none"></div>
                    
                    <form id="registerForm" method="POST" action="<?php echo BASE_URL; ?>/register">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom complet *</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmer le mot de passe *</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                S'inscrire
                            </button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Déjà inscrit ? <a href="<?php echo BASE_URL; ?>/login">Se connecter</a></p>
=======
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
>>>>>>> b-tiavina1
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<?php
$content = ob_get_clean();
$scripts = '
<script>
document.getElementById("registerForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Afficher l\'indicateur de chargement
    const submitBtn = document.getElementById("submitBtn");
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = \'<span class="spinner-border spinner-border-sm"></span> Inscription...\';
    submitBtn.disabled = true;
    
    // Récupérer les données du formulaire
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Envoyer la requête
    fetch("' . BASE_URL . '/register", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Afficher message de succès
            showMessage(data.message || "Inscription réussie !", "success");
            
            // Redirection automatique après 2 secondes
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.href = "' . BASE_URL . '/mes-objets";
                }
            }, 2000);
        } else {
            showMessage(data.error || "Erreur lors de l\'inscription", "danger");
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        showMessage("Une erreur est survenue. Vérifiez la console.", "danger");
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

function showMessage(text, type) {
    const messageDiv = document.getElementById("message");
    messageDiv.textContent = text;
    messageDiv.className = `alert alert-${type}`;
    messageDiv.classList.remove("d-none");
    
    // Auto-masquer après 5 secondes
    setTimeout(() => {
        messageDiv.classList.add("d-none");
    }, 5000);
}
</script>
';

Flight::render("layout", ["title" => "Inscription", "content" => $content, "scripts" => $scripts]);
=======
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "🎊 Inscription - Takalo-takalo", "content" => $content]);
?>
>>>>>>> b-tiavina1
