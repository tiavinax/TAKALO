<?php
ob_start();
?>
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
                </div>
            </div>
        </div>
    </div>
</div>

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
