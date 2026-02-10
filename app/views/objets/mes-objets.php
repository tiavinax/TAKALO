<?php
ob_start();
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mes objets</h2>
        <a href="<?php echo BASE_URL; ?>/ajouter-objet" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un objet
        </a>
    </div>

    <?php if (empty($objets)): ?>
    <div class="alert alert-info">
        Vous n'avez pas encore ajouté d'objets. <a href="<?php echo BASE_URL; ?>/ajouter-objet">Ajoutez votre premier objet</a>
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
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo BASE_URL; ?>/modifier-objet/<?php echo $objet['id']; ?>" 
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <button onclick="supprimerObjet(<?php echo $objet['id']; ?>)" 
                                class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$scripts = '
<script>
function supprimerObjet(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet objet ?")) {
        fetch("' . BASE_URL . '/supprimer-objet/" + id, {
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
                alert("Erreur lors de la suppression");
            }
        });
    }
}
</script>
';

Flight::render("layout", ["title" => "Mes objets", "content" => $content, "scripts" => $scripts]);
