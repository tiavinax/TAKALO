<?php
ob_start();
?>
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/catalogue">Catalogue</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($objet['titre']); ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-md-6">
            <?php if (!empty($photos)): ?>
                <div id="carouselObjet" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($photos as $index => $photo): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $photo['chemin']; ?>" 
                                 class="d-block w-100 photo-objet" 
                                 alt="<?php echo htmlspecialchars($objet['titre']); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($photos) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselObjet" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselObjet" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($objet['titre']); ?></h2>
            <p class="text-muted">Proposé par : <?php echo htmlspecialchars($objet['proprietaire_nom']); ?></p>
            
            <div class="mb-4">
                <h4>Description</h4>
                <p><?php echo nl2br(htmlspecialchars($objet['description'])); ?></p>
            </div>
            
            <div class="mb-4">
                <h4>Prix estimatif</h4>
                <p class="h3 text-primary"><?php echo $objet['prix_estimatif']; ?> €</p>
            </div>
            
            <?php if (!empty($mesObjets)): ?>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Proposer un échange</h5>
                </div>
                <div class="card-body">
                    <form id="proposerEchangeForm">
                        <input type="hidden" name="objet_demande_id" value="<?php echo $objet['id']; ?>">
                        
                        <div class="mb-3">
                            <label for="objet_propose_id" class="form-label">Choisir un de vos objets à échanger</label>
                            <select class="form-select" id="objet_propose_id" name="objet_propose_id" required>
                                <option value="">Sélectionnez un objet</option>
                                <?php foreach ($mesObjets as $monObjet): ?>
                                <option value="<?php echo $monObjet['id']; ?>">
                                    <?php echo htmlspecialchars($monObjet['titre']); ?> (<?php echo $monObjet['prix_estimatif']; ?> €)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-arrow-left-right"></i> Proposer l'échange
                        </button>
                    </form>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-warning">
                Vous devez avoir au moins un objet pour proposer un échange. 
                <a href="<?php echo BASE_URL; ?>/ajouter-objet">Ajoutez un objet</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$scripts = '
<script>
document.getElementById("proposerEchangeForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch("' . BASE_URL . '/proposer-echange", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.href = "' . BASE_URL . '/mes-echanges";
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Une erreur est survenue");
    });
});
</script>
';

Flight::render("layout", ["title" => $objet['titre'], "content" => $content, "scripts" => $scripts]);
