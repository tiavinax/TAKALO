<?php
ob_start();

function getStatutEmoji($statut) {
    switch($statut) {
        case 'en_attente': return '⏳';
        case 'accepte': return '✅';
        case 'refuse': return '❌';
        case 'annule': return '🚫';
        default: return '❓';
    }
}

function getStatutClass($statut) {
    switch($statut) {
        case 'en_attente': return 'warning';
        case 'accepte': return 'success';
        case 'refuse': return 'danger';
        case 'annule': return 'secondary';
        default: return 'light';
    }
}

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

<style>
    .echange-card {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 30px;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .echange-card:hover {
        border-color: #8b5cf6;
        transform: scale(1.02);
    }
    
    .echange-card.en-attente {
        border-left: 10px solid #f59e0b;
    }
    
    .echange-card.accepte {
        border-left: 10px solid #10b981;
    }
    
    .echange-card.refuse {
        border-left: 10px solid #ef4444;
    }
    
    .echange-card.annule {
        border-left: 10px solid #6c757d;
    }
    
    .versus-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0 auto;
        border: 4px solid white;
        box-shadow: 0 0 30px rgba(139,92,246,0.5);
    }
</style>

<div class="container">
    <!-- HEADER DRAMATIQUE -->
    <div class="text-center mb-5">
        <span class="display-1 mb-3 d-block animate-float">🎭</span>
        <h1 class="display-2 fw-bold mb-3">
            <span class="rainbow-text">MES ÉCHANGES</span>
        </h1>
        <p class="lead fs-2 text-secondary">
            <?php echo count($echanges); ?> proposition<?php echo count($echanges) > 1 ? 's' : ''; ?> • 
            <?php 
            $en_attente = array_filter($echanges, fn($e) => $e['statut'] == 'en_attente');
            echo count($en_attente); ?> en attente
        </p>
    </div>

    <?php if (empty($echanges)): ?>
        <div class="text-center py-5">
            <div class="display-1 mb-4">😴</div>
            <h2 class="display-4 fw-bold mb-3">Aucun échange pour l'instant</h2>
            <p class="fs-2 text-secondary mb-4">Va faire un tour dans le catalogue !</p>
            <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-primary btn-lg px-5 py-4 fs-2 rounded-pill">
                <span class="me-2">🔍</span>
                EXPLORER LE CATALOGUE
                <span class="ms-2">✨</span>
            </a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($echanges as $echange): ?>
                <div class="col-12 mb-4">
                    <div class="echange-card <?php echo $echange['statut']; ?> p-4">
                        <!-- STATUT BADGE -->
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <span class="badge bg-<?php echo getStatutClass($echange['statut']); ?> p-3 fs-5 rounded-pill">
                                    <span class="me-2"><?php echo getStatutEmoji($echange['statut']); ?></span>
                                    <?php echo traduireStatut($echange['statut']); ?>
                                </span>
                                <span class="ms-3 text-secondary fs-5">
                                    📅 <?php echo date('d/m/Y H:i', strtotime($echange['created_at'])); ?>
                                </span>
                            </div>
                            <?php if ($echange['statut'] === 'en_attente'): ?>
                                <?php if (isset($echange['proprietaire_demande_id']) && $_SESSION['user_id'] == $echange['proprietaire_demande_id']): ?>
                                    <div>
                                        <span class="badge bg-warning p-3 fs-6 rounded-pill">
                                            ⚡ ACTION REQUISE
                                        </span>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <!-- VERSUS -->
                        <div class="row align-items-center">
                            <!-- OBJET PROPOSÉ -->
                            <div class="col-md-5">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative">
                                        <?php if (!empty($echange['photo_propose'])): ?>
                                            <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $echange['photo_propose']; ?>" 
                                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 20px;"
                                                 alt="<?php echo htmlspecialchars($echange['objet_propose_titre']); ?>">
                                        <?php else: ?>
                                            <div class="bg-dark d-flex align-items-center justify-content-center" 
                                                 style="width: 100px; height: 100px; border-radius: 20px;">
                                                <span class="display-4">📦</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-2 fs-3">
                                            <?php echo htmlspecialchars($echange['objet_propose_titre']); ?>
                                        </h4>
                                        <p class="text-secondary mb-0">
                                            <span class="me-1">🧑</span> 
                                            <?php echo htmlspecialchars($echange['propose_par_nom']); ?>
                                        </p>
                                        <?php if (isset($echange['propose_par_id']) && $echange['propose_par_id'] == $_SESSION['user_id']): ?>
                                            <span class="badge bg-info mt-2">👑 C'est toi !</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- VS -->
                            <div class="col-md-2 text-center">
                                <div class="versus-circle">
                                    VS
                                </div>
                                <div class="mt-2">
                                    <span class="fw-bold">🔄</span>
                                </div>
                            </div>
                            
                            <!-- OBJET DEMANDÉ -->
                            <div class="col-md-5">
                                <div class="d-flex align-items-center gap-3 justify-content-end">
                                    <div class="text-end">
                                        <h4 class="fw-bold mb-2 fs-3">
                                            <?php echo htmlspecialchars($echange['objet_demande_titre']); ?>
                                        </h4>
                                        <p class="text-secondary mb-0">
                                            <span class="me-1">🧑</span>
                                            <?php echo htmlspecialchars($echange['proprietaire_objet_demande_nom']); ?>
                                        </p>
                                        <?php if (isset($echange['proprietaire_demande_id']) && $echange['proprietaire_demande_id'] == $_SESSION['user_id']): ?>
                                            <span class="badge bg-info mt-2">👑 C'est à toi !</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="position-relative">
                                        <?php if (!empty($echange['photo_demande'])): ?>
                                            <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $echange['photo_demande']; ?>" 
                                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 20px;"
                                                 alt="<?php echo htmlspecialchars($echange['objet_demande_titre']); ?>">
                                        <?php else: ?>
                                            <div class="bg-dark d-flex align-items-center justify-content-center" 
                                                 style="width: 100px; height: 100px; border-radius: 20px;">
                                                <span class="display-4">🎯</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ACTIONS -->
                        <?php if ($echange['statut'] === 'en_attente'): ?>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <hr class="border-secondary opacity-25">
                                    <div class="d-flex justify-content-end gap-3 mt-3">
                                        <?php if (isset($echange['proprietaire_demande_id']) && $_SESSION['user_id'] == $echange['proprietaire_demande_id']): ?>
                                            <!-- Propriétaire de l'objet demandé -->
                                            <button onclick="gererEchange(<?php echo $echange['id']; ?>, 'accepter')" 
                                                    class="btn btn-success btn-lg px-5 py-3 fs-4 rounded-pill">
                                                <span class="me-2">✅</span>
                                                ACCEPTER L'ÉCHANGE
                                            </button>
                                            <button onclick="gererEchange(<?php echo $echange['id']; ?>, 'refuser')" 
                                                    class="btn btn-danger btn-lg px-5 py-3 fs-4 rounded-pill">
                                                <span class="me-2">❌</span>
                                                REFUSER
                                            </button>
                                        <?php elseif (isset($echange['propose_par_id']) && $_SESSION['user_id'] == $echange['propose_par_id']): ?>
                                            <!-- Celui qui a proposé -->
                                            <button onclick="gererEchange(<?php echo $echange['id']; ?>, 'annuler')" 
                                                    class="btn btn-warning btn-lg px-5 py-3 fs-4 rounded-pill">
                                                <span class="me-2">🚫</span>
                                                ANNULER LA PROPOSITION
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($echange['statut'] === 'accepte'): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-success p-4 rounded-4 fs-4 text-center mb-0">
                                        <span class="display-6 me-3">🎉</span>
                                        ÉCHANGE RÉUSSI ! Les objets ont changé de propriétaire.
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($echange['statut'] === 'refuse'): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-danger p-4 rounded-4 fs-4 text-center mb-0">
                                        <span class="display-6 me-3">😢</span>
                                        Échange refusé...
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($echange['statut'] === 'annule'): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-secondary p-4 rounded-4 fs-4 text-center mb-0">
                                        <span class="display-6 me-3">⏸️</span>
                                        Proposition annulée
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function gererEchange(echangeId, action) {
    const actions = {
        accepter: { 
            text: "accepter", 
            method: "accepter-echange",
            confirm: "🎉 Super ! Tu vas accepter cet échange. OK ?"
        },
        refuser: { 
            text: "refuser", 
            method: "refuser-echange",
            confirm: "😅 Tu refuses cet échange ?"
        },
        annuler: { 
            text: "annuler", 
            method: "annuler-echange",
            confirm: "🚫 Tu veux annuler ta proposition ?"
        }
    };
    
    if (confirm(actions[action].confirm)) {
        fetch(`<?php echo BASE_URL; ?>/${actions[action].method}/${echangeId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("✅ " + data.message);
                location.reload();
            } else {
                alert("😱 " + (data.error || "Erreur technique"));
            }
        });
    }
}
</script>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "🎭 Mes échanges - Takalo-takalo", "content" => $content]);
?>
