<?php
ob_start();
?>
<style>
    .category-selector {
        background: rgba(139, 92, 246, 0.1);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .category-option {
        transition: all 0.3s ease;
    }
    
    .category-option:hover {
        background: rgba(139, 92, 246, 0.2);
        transform: translateY(-2px);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- HEADER FUN -->
            <div class="text-center mb-5">
                <span class="display-1 mb-3 animate-float d-inline-block">✨</span>
                <h1 class="display-2 fw-bold mb-3 rainbow-text">
                    NOUVEL OBJET
                </h1>
                <p class="lead fs-2 text-secondary">
                    Ajoute ton trésor dans la collection !
                </p>
            </div>
            
            <!-- FORMULAIRE -->
            <div class="form-creative">
                <form id="ajouterObjetForm" enctype="multipart/form-data">
                    
                    <!-- SÉLECTEUR DE CATÉGORIE -->
                    <div class="category-selector mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">🏷️</span> Catégorie *
                        </label>
                        <select class="form-select form-select-lg p-4 fs-4 rounded-4" 
                                id="categorie_id" name="categorie_id" required>
                            <option value="" selected disabled>-- Choisis une catégorie --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>">
                                    <?php echo $cat['icone'] . ' ' . htmlspecialchars($cat['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text text-secondary fs-5 mt-3">
                            💡 Bien catégoriser ton objet aide les autres à le trouver !
                        </div>
                    </div>
                    
                    <!-- TITRE -->
                    <div class="mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">📝</span> Titre *
                        </label>
                        <input type="text" class="form-control form-control-lg p-4 fs-3 rounded-4" 
                               id="titre" name="titre" placeholder="ex: Guitare électrique Fender" required>
                        <div class="form-text text-secondary fs-5 mt-2">
                            Sois précis, c'est la première chose que les gens voient !
                        </div>
                    </div>
                    
                    <!-- DESCRIPTION -->
                    <div class="mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">📄</span> Description
                        </label>
                        <textarea class="form-control form-control-lg p-4 fs-4 rounded-4" 
                                  id="description" name="description" rows="6"
                                  placeholder="État, âge, motifs d'échange, petits défauts... Raconte son histoire !"></textarea>
                    </div>
                    
                    <!-- PRIX -->
                    <div class="mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">💰</span> Prix estimatif (€)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark fs-2 p-3">💶</span>
                            <input type="number" class="form-control form-control-lg p-4 fs-2 rounded-end-4" 
                                   id="prix_estimatif" name="prix_estimatif" step="0.01" min="0" 
                                   placeholder="0.00" required>
                        </div>
                    </div>
                    
                    <!-- PHOTOS -->
                    <div class="mb-5">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">📸</span> Photos
                        </label>
                        <input type="file" class="form-control form-control-lg p-4 fs-4 rounded-4" 
                               id="photos" name="photos[]" multiple accept="image/*">
                        <div class="form-text text-secondary fs-5 mt-2">
                            🖼️ 1 à 5 photos • La première sera la photo principale
                        </div>
                    </div>
                    
                    <!-- BOUTONS -->
                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg py-4 fs-2 rounded-pill"
                                style="background: linear-gradient(45deg, #8b5cf6, #6d28d9);">
                            <span class="me-2">🚀</span>
                            PUBLIER MON OBJET
                            <span class="ms-2">✨</span>
                        </button>
                        <a href="<?php echo BASE_URL; ?>/mes-objets" class="btn btn-outline-secondary btn-lg py-4 fs-3 rounded-pill">
                            ANNULER
                        </a>
                    </div>
                </form>
            </div>
            
            <!-- PETITS CONSEILS -->
            <div class="alert alert-info mt-5 p-4 rounded-4 fs-4" style="background: rgba(139,92,246,0.1);">
                <div class="d-flex align-items-center">
                    <span class="display-4 me-3">💎</span>
                    <div>
                        <strong class="fs-3">Les objets bien décrits s'échangent 3x plus vite !</strong>
                        <p class="mt-2 mb-0 text-secondary">Ajoute des détails : marque, taille, année, état...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("ajouterObjetForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> PUBLICATION...';
    
    fetch("<?php echo BASE_URL; ?>/ajouter-objet", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("🎉 Super ! Ton objet a été ajouté !");
            window.location.href = "<?php echo BASE_URL; ?>/mes-objets";
        } else {
            alert("😅 " + (data.error || "Erreur technique"));
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("😱 Une erreur est survenue... Réessaie !");
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});
</script>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "✨ Ajouter un objet - Takalo-takalo", "content" => $content]);
?>
