<?php
ob_start();
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <span class="display-1 mb-3 animate-float d-inline-block">✏️</span>
                <h1 class="display-2 fw-bold mb-3 rainbow-text">
                    MODIFIER L'OBJET
                </h1>
            </div>
            
            <div class="form-creative">
                <form id="modifierObjetForm">
                    
                    <!-- CATÉGORIE -->
                    <div class="category-selector mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">🏷️</span> Catégorie
                        </label>
                        <select class="form-select form-select-lg p-4 fs-4 rounded-4" 
                                id="categorie_id" name="categorie_id">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" 
                                    <?php echo ($objet['categorie_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                    <?php echo $cat['icone'] . ' ' . htmlspecialchars($cat['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- TITRE -->
                    <div class="mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">📝</span> Titre
                        </label>
                        <input type="text" class="form-control form-control-lg p-4 fs-3 rounded-4" 
                               id="titre" name="titre" value="<?php echo htmlspecialchars($objet['titre']); ?>" required>
                    </div>
                    
                    <!-- DESCRIPTION -->
                    <div class="mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">📄</span> Description
                        </label>
                        <textarea class="form-control form-control-lg p-4 fs-4 rounded-4" 
                                  id="description" name="description" rows="6"><?php echo htmlspecialchars($objet['description']); ?></textarea>
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
                                   value="<?php echo $objet['prix_estimatif']; ?>" required>
                        </div>
                    </div>
                    
                    <!-- PHOTOS ACTUELLES -->
                    <?php if (!empty($photos)): ?>
                    <div class="mb-4">
                        <label class="form-label fs-3 mb-3">
                            <span class="me-2">🖼️</span> Photos actuelles
                        </label>
                        <div class="d-flex gap-3 flex-wrap">
                            <?php foreach ($photos as $photo): ?>
                                <div class="position-relative">
                                    <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $photo['chemin']; ?>" 
                                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 15px;">
                                    <?php if ($photo['est_principale']): ?>
                                        <span class="position-absolute top-0 start-0 badge bg-primary p-2">⭐ PRINCIPALE</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-text text-secondary fs-5 mt-3">
                            📌 Pour changer les photos, supprime et ré-ajoute l'objet
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- BOUTONS -->
                    <div class="d-grid gap-3 mt-5">
                        <button type="submit" class="btn btn-primary btn-lg py-4 fs-2 rounded-pill">
                            <span class="me-2">💾</span>
                            METTRE À JOUR
                        </button>
                        <a href="<?php echo BASE_URL; ?>/mes-objets" class="btn btn-outline-secondary btn-lg py-4 fs-3 rounded-pill">
                            RETOUR À MA COLLECTION
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("modifierObjetForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    const data = {
        titre: document.getElementById("titre").value,
        description: document.getElementById("description").value,
        prix_estimatif: document.getElementById("prix_estimatif").value,
        categorie_id: document.getElementById("categorie_id").value
    };
    
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> MISE À JOUR...';
    
    fetch("<?php echo BASE_URL; ?>/modifier-objet/<?php echo $objet['id']; ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("✅ Objet modifié avec succès !");
            window.location.href = "<?php echo BASE_URL; ?>/mes-objets";
        } else {
            alert("😅 " + (data.error || "Erreur technique"));
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("😱 Une erreur est survenue...");
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});
</script>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "✏️ Modifier - Takalo-takalo", "content" => $content]);
?>
