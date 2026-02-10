<?php
ob_start();

// Fonction pour obtenir la classe CSS selon le statut
function getStatutClass($statut) {
    switch($statut) {
        case 'en_attente': return 'warning';
        case 'accepte': return 'success';
        case 'refuse': return 'danger';
        case 'annule': return 'secondary';
        default: return 'light';
    }
}

// Fonction pour traduire le statut
function traduireStatut($statut) {
    $traductions = [
        'en_attente' => 'En attente',
        'accepte' => 'Accepté',
        'refuse' => 'Refusé',
        'annule' => 'Annulé'
    ];
    return $traductions[$statut] ?? $statut;
}
?>
<div class="container">
    <h2 class="mb-4">Mes échanges</h2>
    
    <?php if (empty($echanges)): ?>
    <div class="alert alert-info">
        Vous n'avez pas encore d'échanges.
    </div>
    <?php else: ?>
    <div class="accordion" id="accordionEchanges">
        <?php foreach ($echanges as $index => $echange): ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                <button class="accordion-button <?php echo $index !== 0 ? 'collapsed' : ''; ?>" 
                        type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapse<?php echo $index; ?>" 
                        aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" 
                        aria-controls="collapse<?php echo $index; ?>">
                    <span class="badge bg-<?php echo getStatutClass($echange['statut']); ?> me-2">
                        <?php echo traduireStatut($echange['statut']); ?>
                    </span>
                    <?php echo htmlspecialchars($echange['objet_propose_titre']); ?> 
                    <i class="bi bi-arrow-left-right mx-2"></i>
                    <?php echo htmlspecialchars($echange['objet_demande_titre']); ?>
                </button>
            </h2>
            <div id="collapse<?php echo $index; ?>" 
                 class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" 
                 aria-labelledby="heading<?php echo $index; ?>" 
                 data-bs-parent="#accordionEchanges">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Objet proposé
                                </div>
                                <div class="card-body">
                                    <h6><?php echo htmlspecialchars($echange['objet_propose_titre']); ?></h6>
                                    <?php if ($echange['photo_propose']): ?>
                                    <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $echange['photo_propose']; ?>" 
                                         class="img-fluid rounded mb-2" style="max-height: 150px;">
                                    <?php endif; ?>
                                    <p class="mb-0"><small>Proposé par : <?php echo htmlspecialchars($echange['propose_par_nom']); ?></small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    Objet demandé
                                </div>
                                <div class="card-body">
                                    <h6><?php echo htmlspecialchars($echange['objet_demande_titre']); ?></h6>
                                    <?php if ($echange['photo_demande']): ?>
                                    <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $echange['photo_demande']; ?>" 
                                         class="img-fluid rounded mb-2" style="max-height: 150px;">
                                    <?php endif; ?>
                                    <p class="mb-0"><small>Propriétaire : <?php echo htmlspecialchars($echange['proprietaire_objet_demande_nom']); ?></small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 d-flex flex-column justify-content-center">
                            <?php if ($echange['statut'] === 'en_attente'): ?>
                                <?php if ($_SESSION['user_name'] === $echange['proprietaire_objet_demande_nom']): ?>
                                    <!-- Propriétaire de l'objet demandé -->
                                    <button onclick="gererEchange(<?php echo $echange['id']; ?>, 'accepter')" 
                                            class="btn btn-success btn-sm mb-2">
                                        <i class="bi bi-check-circle"></i> Accepter
                                    </button>
                                    <button onclick="gererEchange(<?php echo $echange['id']; ?>, 'refuser')" 
                                            class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Refuser
                                    </button>
                                <?php else: ?>
                                    <!-- Celui qui a proposé l'échange -->
                                    <button onclick="gererEchange(<?php echo $echange['id']; ?>, 'annuler')" 
                                            class="btn btn-warning btn-sm">
                                        <i class="bi bi-x-circle"></i> Annuler
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="mt-3 text-muted">
                        <small>Proposé le : <?php echo date('d/m/Y H:i', strtotime($echange['created_at'])); ?></small>
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
function gererEchange(echangeId, action) {
    const actions = {
        accepter: { text: "accepter", method: "accepter-echange" },
        refuser: { text: "refuser", method: "refuser-echange" },
        annuler: { text: "annuler", method: "annuler-echange" }
    };
    
    if (confirm(`Êtes-vous sûr de vouloir ${actions[action].text} cet échange ?`)) {
        fetch(`' . BASE_URL . '/${actions[action].method}/${echangeId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.error || "Erreur lors de l\'opération");
            }
        });
    }
}
</script>
';

Flight::render("layout", ["title" => "Mes échanges", "content" => $content, "scripts" => $scripts]);
