<?php
ob_start();
?>
<<<<<<< HEAD
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Connexion</h4>
                </div>
                <div class="card-body">
                    <!-- Message d'erreur/succès -->
                    <div id="message" class="alert d-none"></div>
                    
                    <form id="loginForm" method="POST" action="<?php echo BASE_URL; ?>/login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required 
                                   value="jean@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="password" name="password" required 
                                   value="password">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Se connecter
                            </button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Pas encore inscrit ? <a href="<?php echo BASE_URL; ?>/register">Créer un compte</a></p>
                    </div>
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
        content: "🔐";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 10rem;
        opacity: 0.05;
        transform: rotate(10deg);
    }
    
    .floating-emoji {
        position: absolute;
        font-size: 2.5rem;
        opacity: 0.2;
        animation: floatEmoji 8s linear infinite;
    }
    
    @keyframes floatEmoji {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
        100% { transform: translateY(0) rotate(0deg); }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Emojis flottants -->
            <div class="floating-emoji" style="top: 10%; left: 5%;">🎮</div>
            <div class="floating-emoji" style="top: 70%; right: 5%; animation-delay: 2s;">📚</div>
            <div class="floating-emoji" style="top: 40%; left: 80%; animation-delay: 4s;">🎸</div>
            
            <div class="auth-card-fun">
                <div class="text-center mb-5">
                    <span class="display-2 mb-3 d-inline-block animate-float">👋</span>
                    <h1 class="display-3 fw-bold mb-3 rainbow-text">
                        CONTENT DE TE REVOIR !
                    </h1>
                    <p class="fs-3 text-secondary">
                        Connecte-toi pour continuer l'aventure
                    </p>
                </div>
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success p-4 rounded-4 fs-4 mb-4">
                        <span class="me-2">✅</span> <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger p-4 rounded-4 fs-4 mb-4">
                        <span class="me-2">😅</span> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo BASE_URL; ?>/login">
                    <div class="mb-4">
                        <label class="form-label fs-4 mb-2">
                            <span class="me-2">📧</span> Email
                        </label>
                        <input type="email" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               name="email" value="<?php echo htmlspecialchars($old_email ?? ''); ?>" 
                               placeholder="exemple@email.com" required>
                    </div>
                    
                    <div class="mb-5">
                        <label class="form-label fs-4 mb-2">
                            <span class="me-2">🔒</span> Mot de passe
                        </label>
                        <input type="password" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               name="password" placeholder="••••••••" required>
                    </div>
                    
                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg py-4 fs-2 rounded-pill"
                                style="background: linear-gradient(45deg, #8b5cf6, #6d28d9);">
                            <span class="me-2">🚀</span>
                            SE CONNECTER
                        </button>
                        
                        <div class="text-center mt-4">
                            <p class="fs-4 text-secondary">
                                Pas encore de compte ? 
                                <a href="<?php echo BASE_URL; ?>/register" class="text-decoration-none fw-bold">
                                    Créer un compte <span class="ms-1">✨</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- TESTIMONIAL EXPRESS -->
            <div class="text-center mt-5">
                <div class="d-flex justify-content-center gap-3">
                    <span class="badge bg-dark p-3 fs-5 rounded-pill">⭐ 4.9/5</span>
                    <span class="badge bg-dark p-3 fs-5 rounded-pill">👥 892 membres</span>
                    <span class="badge bg-dark p-3 fs-5 rounded-pill">🔄 +3000 échanges</span>
>>>>>>> b-tiavina1
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
// Pré-remplir avec des données de test (à retirer en production)
document.addEventListener("DOMContentLoaded", function() {
    // Les champs sont déjà pré-remplis dans le HTML
});

document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Afficher l\'indicateur de chargement
    const submitBtn = document.getElementById("submitBtn");
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = \'<span class="spinner-border spinner-border-sm"></span> Connexion...\';
    submitBtn.disabled = true;
    
    // Récupérer les données du formulaire
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Envoyer la requête
    fetch("' . BASE_URL . '/login", {
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
            showMessage("Connexion réussie ! Redirection...", "success");
            
            // Redirection automatique
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.href = "' . BASE_URL . '/mes-objets";
                }
            }, 1000);
        } else {
            showMessage(data.error || "Email ou mot de passe incorrect", "danger");
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

Flight::render("layout", ["title" => "Connexion", "content" => $content, "scripts" => $scripts]);
=======
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "🔐 Connexion - Takalo-takalo", "content" => $content]);
?>
>>>>>>> b-tiavina1
