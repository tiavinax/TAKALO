<?php
ob_start();
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- En-tête avec étapes -->
            <div class="mb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/mes-objets">Mes objets</a></li>
                        <li class="breadcrumb-item active">Ajouter un objet</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                        <i class="bi bi-plus-circle display-6"></i>
                    </div>
                    <div>
                        <h1 class="h2 fw-bold mb-1">Ajouter un nouvel objet</h1>
                        <p class="text-muted mb-0">Remplissez les informations de votre objet pour commencer à échanger</p>
                    </div>
                </div>

                <!-- Barre de progression -->
                <div class="progress-steps mb-5">
                    <div class="d-flex justify-content-between position-relative">
                        <div class="step active text-center">
                            <div class="step-circle bg-primary text-white">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="step-label mt-2 small fw-semibold">Informations</div>
                        </div>
                        <div class="step text-center">
                            <div class="step-circle bg-light text-muted">
                                <i class="bi bi-images"></i>
                            </div>
                            <div class="step-label mt-2 small text-muted">Photos</div>
                        </div>
                        <div class="step text-center">
                            <div class="step-circle bg-light text-muted">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="step-label mt-2 small text-muted">Confirmation</div>
                        </div>
                        <div class="progress-line position-absolute top-50 start-0 end-0">
                            <div class="progress-bar" style="width: 33%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-info text-white py-4">
                    <h3 class="h4 mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Détails de l'objet
                    </h3>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form id="ajouterObjetForm" enctype="multipart/form-data">
                        <div class="row g-4">
                            <!-- Titre -->
                            <div class="col-12">
                                <label for="titre" class="form-label fw-semibold">
                                    <i class="bi bi-card-heading text-primary me-2"></i>
                                    Titre de l'objet *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-tag text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-lg border-start-0"
                                        id="titre" name="titre"
                                        placeholder="Ex: Livre 'Le Petit Prince', Veste en cuir..."
                                        required>
                                </div>
                                <div class="form-text">
                                    Donnez un titre clair et attractif à votre objet
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="bi bi-card-text text-primary me-2"></i>
                                    Description détaillée
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
                                        <i class="bi bi-text-paragraph text-muted"></i>
                                    </span>
                                    <textarea class="form-control border-start-0"
                                        id="description" name="description"
                                        rows="5"
                                        placeholder="Décrivez votre objet en détail : état, marque, dimensions, défauts éventuels..."></textarea>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="form-text">
                                        Plus la description est détaillée, plus vous aurez de chances de trouver un échangeur
                                    </div>
                                    <span id="charCount" class="text-muted small">0/500</span>
                                </div>
                            </div>

                            <!-- Prix estimatif -->
                            <div class="col-md-6">
                                <label for="prix_estimatif" class="form-label fw-semibold">
                                    <i class="bi bi-currency-euro text-primary me-2"></i>
                                    Prix estimatif (€)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-cash-coin text-muted"></i>
                                    </span>
                                    <input type="number" class="form-control border-start-0"
                                        id="prix_estimatif" name="prix_estimatif"
                                        step="0.01" min="0"
                                        placeholder="0.00">
                                    <span class="input-group-text">€</span>
                                </div>
                                <div class="form-text">
                                    Estimation de la valeur de votre objet
                                </div>
                            </div>

                            <!-- Catégorie (optionnel pour plus tard) -->
                            <div class="col-md-6">
                                <label for="categorie" class="form-label fw-semibold">
                                    <i class="bi bi-grid text-primary me-2"></i>
                                    Catégorie
                                </label>
                                <select class="form-select" id="categorie" name="categorie">
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="livres">Livres & Médias</option>
                                    <option value="vetements">Vêtements & Accessoires</option>
                                    <option value="electronique">Électronique</option>
                                    <option value="maison">Maison & Jardin</option>
                                    <option value="sport">Sport & Loisirs</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>

                            <!-- Photos -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-camera text-primary me-2"></i>
                                    Photos de l'objet
                                </label>

                                <!-- Zone de dépôt -->
                                <div class="drop-zone border-2 border-dashed rounded-3 p-5 text-center mb-4"
                                    id="dropZone">
                                                                       <input type="file" class="form-control visually-hidden"
                                        id="photos" name="photos[]"
                                        multiple accept="image/*"
                                        style="opacity: 0; position: absolute; width: 100%; height: 100%; top: 0; left: 0; cursor: pointer;">
                                    <button type="button" class="btn btn-outline-primary position-relative"
                                        style="z-index: 2;">
                                        <i class="bi bi-folder2-open me-2"></i>Choisir des photos
                                    </button>
                                    <p class="small text-muted mt-3 mb-0">
                                        Formats acceptés : JPG, PNG, GIF (max 5MB par photo)
                                    </p>
                                </div>

                                <!-- Prévisualisation -->
                                <div id="imagePreview" class="row g-3"></div>

                                <div class="form-text mt-3">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Ajoutez plusieurs photos sous différents angles. La première photo sera la photo principale.
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                            <a href="<?php echo BASE_URL; ?>/mes-objets"
                                class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="bi bi-plus-circle me-2"></i>
                                Ajouter l'objet
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Conseils -->
                <div class="card-footer bg-light border-0 py-4">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                    <i class="bi bi-camera"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Bonne luminosité</h6>
                                    <p class="mb-0 small text-muted">Prenez vos photos en pleine lumière</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Soyez honnête</h6>
                                    <p class="mb-0 small text-muted">Décrivez précisément l'état de l'objet</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-3">
                                    <i class="bi bi-star"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Attirez l'attention</h6>
                                    <p class="mb-0 small text-muted">Un bon titre et des photos attirent plus d'échangeurs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .drop-zone {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-color: #c3cfe2;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .drop-zone:hover,
    .drop-zone.dragover {
        background: linear-gradient(135deg, #e9ecef, #dee2e6);
        border-color: #4361ee;
        transform: translateY(-2px);
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .progress-line {
        height: 3px;
        background-color: #e9ecef;
        z-index: 0;
        top: 25px;
    }

    .progress-bar {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        height: 100%;
        transition: width 0.3s ease;
    }

    .step.active .step-circle {
        transform: scale(1.1);
        box-shadow: 0 0 0 5px rgba(67, 97, 238, 0.2);
    }

    .image-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
    }

    .preview-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--primary-color);
        color: white;
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 10px;
    }

    .char-counter {
        font-size: 0.85rem;
    }
</style>

<?php
$content = ob_get_clean();
$scripts = '
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Compteur de caractères
    const description = document.getElementById("description");
    const charCount = document.getElementById("charCount");
    
    description.addEventListener("input", function() {
        const length = this.value.length;
        charCount.textContent = length + "/500";
        
        if (length > 500) {
            charCount.classList.add("text-danger");
        } else {
            charCount.classList.remove("text-danger");
        }
    });
    
    // Gestion du drag and drop
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("photos");
    const browseBtn = document.getElementById("browseBtn");
    const previewContainer = document.getElementById("imagePreview");
    
    browseBtn.addEventListener("click", () => fileInput.click());
    
    dropZone.addEventListener("click", () => fileInput.click());
    
    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("dragover");
    });
    
    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragover");
    });
    
    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("dragover");
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            updatePreview();
        }
    });
    
    fileInput.addEventListener("change", updatePreview);
    
    function updatePreview() {
        previewContainer.innerHTML = "";
        
        Array.from(fileInput.files).forEach((file, index) => {
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement("div");
                    col.className = "col-6 col-md-4 col-lg-3";
                    
                    const card = document.createElement("div");
                    card.className = "card border-0 shadow-sm";
                    
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "card-img-top image-preview";
                    img.style.height = "150px";
                    img.style.objectFit = "cover";
                    
                    const cardBody = document.createElement("div");
                    cardBody.className = "card-body p-2";
                    
                    const badge = document.createElement("span");
                    badge.className = "badge " + (index === 0 ? "bg-primary" : "bg-secondary");
                    badge.textContent = index === 0 ? "Principale" : "Photo " + (index + 1);
                    
                    const fileName = document.createElement("p");
                    fileName.className = "small text-muted mb-0 text-truncate";
                    fileName.textContent = file.name;
                    
                    cardBody.appendChild(badge);
                    cardBody.appendChild(fileName);
                    card.appendChild(img);
                    card.appendChild(cardBody);
                    col.appendChild(card);
                    previewContainer.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Soumission du formulaire
    document.getElementById("ajouterObjetForm").addEventListener("submit", function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Validation
        const titre = document.getElementById("titre").value.trim();
        if (!titre) {
            showAlert("danger", "Veuillez saisir un titre pour votre objet");
            return;
        }
        
        // Afficher un indicateur de chargement
        const submitBtn = this.querySelector("button[type=\'submit\']");
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = \'<span class="spinner-border spinner-border-sm me-2"></span>Ajout en cours...\';
        submitBtn.disabled = true;
        
        fetch("' . BASE_URL . '/ajouter-objet", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert("success", "Objet ajouté avec succès !");
                submitBtn.innerHTML = \'<i class="bi bi-check-circle me-2"></i>Ajouté !\';
                submitBtn.classList.remove("btn-primary");
                submitBtn.classList.add("btn-success");
                
                // Redirection après 2 secondes
                setTimeout(() => {
                    window.location.href = "' . BASE_URL . '/mes-objets";
                }, 2000);
            } else {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showAlert("danger", data.error || "Erreur lors de l\'ajout de l\'objet");
            }
        })
        .catch(error => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            showAlert("danger", "Une erreur est survenue lors de l\'envoi");
            console.error("Error:", error);
        });
    });
});

function showAlert(type, message) {
    // Supprimer les alertes existantes
    const existingAlert = document.querySelector(".alert-dismissible");
    if (existingAlert) existingAlert.remove();
    
    // Créer une nouvelle alerte
    const alert = document.createElement("div");
    alert.className = \`alert alert-\${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3\`;
    alert.style.zIndex = "1050";
    alert.innerHTML = \`
        <i class="bi \${type === \'success\' ? \'bi-check-circle-fill\' : \'bi-exclamation-triangle-fill\'} me-2"></i>
        \${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    \`;
    
    document.body.appendChild(alert);
    
    // Auto-dismiss après 5 secondes
    setTimeout(() => {
        if (alert.parentNode) {
            alert.classList.remove("show");
            setTimeout(() => alert.remove(), 150);
        }
    }, 5000);
}
</script>
';

Flight::render("layout", ["title" => "Ajouter un objet - Takalo-takalo", "content" => $content, "scripts" => $scripts]);
