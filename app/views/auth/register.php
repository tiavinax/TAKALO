<?php
ob_start();
?>
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
