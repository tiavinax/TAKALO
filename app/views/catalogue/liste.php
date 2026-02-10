<?php
ob_start();
?>
<div class="container">
    <h2 class="mb-4">Catalogue des objets disponibles</h2>
    
    <?php if (empty($objets)): ?>
    <div class="alert alert-info">
        Aucun objet disponible pour le moment.
    </div>
    <?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($objets as $objet): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <?php if ($objet['photo_principale']): ?>
                <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $objet['photo_principale']; ?>" 
                     class="card-img-top" alt="<?php echo htmlspecialchars($objet['titre']); ?>"
                     style="height: 200px; object-fit: cover;">
                <?php else: ?>
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($objet['titre']); ?></h5>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($objet['description'], 0, 100))); ?>...</p>
                    <p class="card-text"><strong>Prix estimatif :</strong> <?php echo $objet['prix_estimatif']; ?> €</p>
                    <p class="card-text"><small class="text-muted">Proposé par : <?php echo htmlspecialchars($objet['proprietaire_nom']); ?></small></p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo BASE_URL; ?>/objet/<?php echo $objet['id']; ?>" 
                       class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-eye"></i> Voir les détails
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "Catalogue", "content" => $content]);
