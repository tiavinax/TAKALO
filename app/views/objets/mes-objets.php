<?php
ob_start();
?>
<style>
    .collection-header {
        background: linear-gradient(135deg, rgba(109,40,217,0.2), rgba(16,185,129,0.1));
        border-radius: 50px;
        padding: 2rem;
        border: 2px solid rgba(255,255,255,0.05);
        margin-bottom: 3rem;
    }
    
    .objet-perso-card {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 30px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .objet-perso-card:hover {
        border-color: #10b981;
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(16,185,129,0.2);
    }
    
    .proprio-stamp {
        position: absolute;
        bottom: 20px;
        right: 20px;
        font-size: 3rem;
        opacity: 0.2;
        transform: rotate(-10deg);
    }
    
    .badge-proprio {
        background: rgba(16,185,129,0.2);
        color: #10b981;
        border: 1px solid #10b981;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
    }
    
    .empty-collection {
        background: rgba(139, 92, 246, 0.1);
        border: 3px dashed #8b5cf6;
        border-radius: 60px;
        padding: 5rem;
        text-align: center;
    }
</style>

<div class="container">
    <!-- HEADER COLLECTION -->
    <div class="collection-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="display-3 fw-bold mb-2">
                <span class="rainbow-text">🎁 MA COLLECTION</span>
            </h1>
            <p class="lead fs-2 text-secondary">
                <?php echo count($objets); ?> trésor<?php echo count($objets) > 1 ? 's' : ''; ?> dans ton coffre
            </p>
        </div>
        <div>
            <a href="<?php echo BASE_URL; ?>/ajouter-objet" class="btn btn-primary btn-lg px-5 py-4 fs-2 rounded-pill shadow-lg"
               style="background: linear-gradient(45deg, #8b5cf6, #6d28d9);">
                <span class="me-2">➕</span>
                AJOUTER
            </a>
        </div>
    </div>

    <?php if (empty($objets)): ?>
        <div class="empty-collection my-5">
            <span class="display-1 mb-4">🏴‍☠️</span>
            <h2 class="display-4 fw-bold mb-3">C'est vide par ici...</h2>
            <p class="fs-2 text-secondary mb-4">Ajoute ton premier objet et commence l'aventure !</p>
            <a href="<?php echo BASE_URL; ?>/ajouter-objet" class="btn btn-primary btn-lg px-5 py-4 fs-2 rounded-pill">
                <span class="me-2">🚀</span>
                AJOUTER UN OBJET
                <span class="ms-2">✨</span>
            </a>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($objets as $objet): ?>
                <div class="col">
                    <div class="objet-perso-card h-100">
                        <!-- Badge propriétaire -->
                        <div class="position-absolute top-0 start-0 m-4 z-1">
                            <span class="badge-proprio">
                                <span class="me-1">👑</span> À MOI
                            </span>
                        </div>
                        
                        <!-- Image ou emoji -->
                        <?php if ($objet['photo_principale']): ?>
                            <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $objet['photo_principale']; ?>" 
                                 class="card-img-top" alt="<?php echo htmlspecialchars($objet['titre']); ?>"
                                 style="height: 250px; object-fit: cover; border-radius: 30px 30px 0 0;">
                        <?php else: ?>
                            <div class="bg-dark d-flex align-items-center justify-content-center" 
                                 style="height: 250px; border-radius: 30px 30px 0 0;">
                                <span class="display-1">📦</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-4">
                            <!-- Titre -->
                            <h3 class="fw-bold mb-3 fs-2">
                                <?php echo htmlspecialchars($objet['titre']); ?>
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-secondary mb-3 fs-5">
                                <?php echo nl2br(htmlspecialchars(substr($objet['description'], 0, 80))); ?>...
                            </p>
                            
                            <!-- Prix -->
                            <div class="d-flex align-items-center mb-4">
                                <span class="badge bg-warning text-dark p-3 fs-5 rounded-pill">
                                    💰 <?php echo $objet['prix_estimatif']; ?> €
                                </span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="d-flex gap-2">
                                <a href="<?php echo BASE_URL; ?>/modifier-objet/<?php echo $objet['id']; ?>" 
                                   class="btn btn-outline-primary flex-grow-1 py-3 fs-5 rounded-pill">
                                    <span class="me-1">✏️</span> Modifier
                                </a>
                                <button onclick="supprimerObjet(<?php echo $objet['id']; ?>)" 
                                        class="btn btn-outline-danger py-3 px-4 fs-5 rounded-pill">
                                    <span class="me-1">🗑️</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Stamp propriétaire -->
                        <div class="proprio-stamp">
                            👤
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- PETITE ASTUCE -->
        <div class="alert alert-info mt-5 p-4 rounded-4 fs-4" style="background: rgba(139,92,246,0.1); border: none;">
            <span class="display-6 me-3">💡</span>
            Plus t'as d'objets, plus t'as de chances de faire des échanges cools !
        </div>
    <?php endif; ?>
</div>

<script>
function supprimerObjet(id) {
    if (confirm("😱 Sûr·e de vouloir supprimer cet objet ?")) {
        fetch("<?php echo BASE_URL; ?>/supprimer-objet/" + id, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert("😅 Erreur lors de la suppression");
            }
        });
    }
}
</script>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "📦 Mes objets - Takalo-takalo", "content" => $content]);
?>
