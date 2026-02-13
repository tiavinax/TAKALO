<?php
ob_start();
?>
<style>
    .timeline-global {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 40px;
        padding: 3rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .timeline-global::before {
        content: "📜";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 12rem;
        opacity: 0.05;
        transform: rotate(-10deg);
    }
    
    .historique-card {
        background: rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .historique-card:hover {
        border-color: #8b5cf6;
        transform: translateX(10px);
        background: rgba(139,92,246,0.1);
    }
    
    .empty-historique {
        background: rgba(139,92,246,0.1);
        border: 3px dashed #8b5cf6;
        border-radius: 40px;
        padding: 4rem;
        text-align: center;
    }
    
    .transfer-arrow {
        font-size: 2rem;
        margin: 0 1rem;
        color: #8b5cf6;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(5px); }
    }
</style>

<div class="container">
    <div class="timeline-global">
        <!-- HEADER -->
        <div class="d-flex align-items-center gap-4 mb-5">
            <div class="display-1 animate-float">📜</div>
            <div>
                <h1 class="display-2 fw-bold rainbow-text mb-2">
                    HISTORIQUE GLOBAL
                </h1>
                <p class="fs-3 text-secondary">
                    Tous les échanges réussis sur Takalo-takalo
                </p>
            </div>
        </div>
        
        <?php if (empty($historique)): ?>
            <!-- AUCUN HISTORIQUE -->
            <div class="empty-historique">
                <span class="display-1 mb-4 d-block">🕊️</span>
                <h2 class="display-4 fw-bold mb-3">Aucun échange pour l'instant</h2>
                <p class="fs-2 text-secondary mb-4">
                    Sois le premier à faire un échange !
                </p>
                <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-primary btn-lg px-5 py-4 fs-3 rounded-pill">
                    <span class="me-2">🔍</span>
                    EXPLORER LE CATALOGUE
                </a>
            </div>
        <?php else: ?>
            <!-- STATISTIQUES RAPIDES -->
            <div class="row mb-4 g-3">
                <div class="col-md-4">
                    <div class="bg-dark bg-opacity-25 p-4 rounded-4 text-center">
                        <span class="display-4 d-block">🔄</span>
                        <span class="fs-2 fw-bold"><?php echo count($historique); ?></span>
                        <span class="d-block text-secondary">échanges réussis</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-dark bg-opacity-25 p-4 rounded-4 text-center">
                        <span class="display-4 d-block">👥</span>
                        <?php 
                        $users = array_unique(array_column($historique, 'nouveau_proprietaire_nom'));
                        ?>
                        <span class="fs-2 fw-bold"><?php echo count($users); ?></span>
                        <span class="d-block text-secondary">participants</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-dark bg-opacity-25 p-4 rounded-4 text-center">
                        <span class="display-4 d-block">📦</span>
                        <?php 
                        $objets = array_unique(array_column($historique, 'objet_id'));
                        ?>
                        <span class="fs-2 fw-bold"><?php echo count($objets); ?></span>
                        <span class="d-block text-secondary">objets échangés</span>
                    </div>
                </div>
            </div>
            
            <!-- LISTE DES ÉCHANGES -->
            <div class="mt-5">
                <?php foreach ($historique as $index => $h): ?>
                    <div class="historique-card">
                        <div class="row align-items-center">
                            <!-- COLONNE 1 : OBJET -->
                            <div class="col-md-1 text-center">
                                <span class="display-5"><?php echo $h['categorie_icone'] ?? '📦'; ?></span>
                            </div>
                            
                            <!-- COLONNE 2 : TITRE OBJET -->
                            <div class="col-md-3">
                                <a href="<?php echo BASE_URL; ?>/objet/<?php echo $h['objet_id']; ?>" 
                                   class="text-decoration-none text-white">
                                    <strong class="fs-3"><?php echo htmlspecialchars(substr($h['objet_titre'], 0, 30)); ?></strong>
                                    <?php if (strlen($h['objet_titre']) > 30): ?>...<?php endif; ?>
                                </a>
                                <div class="text-secondary">
                                    <?php echo $h['categorie_nom'] ?? 'Autre'; ?>
                                </div>
                            </div>
                            
                            <!-- COLONNE 3 : TRANSFERT -->
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-start">
                                    <span class="badge bg-dark p-3 fs-6 rounded-pill">
                                        <span class="me-1">🧑</span>
                                        <?php echo htmlspecialchars($h['ancien_proprietaire_nom']); ?>
                                    </span>
                                    <span class="transfer-arrow mx-3">→</span>
                                    <span class="badge bg-success p-3 fs-6 rounded-pill">
                                        <span class="me-1">👤</span>
                                        <?php echo htmlspecialchars($h['nouveau_proprietaire_nom']); ?>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- COLONNE 4 : DATE -->
                            <div class="col-md-2">
                                <span class="text-muted fs-5">
                                    <span class="me-1">📅</span>
                                    <?php echo date('d/m/Y', strtotime($h['date_echange'])); ?>
                                </span>
                                <br>
                                <small class="text-secondary">
                                    <?php echo date('H:i', strtotime($h['date_echange'])); ?>
                                </small>
                            </div>
                            
                            <!-- COLONNE 5 : BOUTON -->
                            <div class="col-md-2 text-end">
                                <a href="<?php echo BASE_URL; ?>/historique/<?php echo $h['objet_id']; ?>" 
                                   class="btn btn-outline-primary rounded-pill px-4 py-2 fs-5">
                                    <span class="me-1">📋</span>
                                    Détails
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- LÉGENDE -->
            <div class="mt-5 text-center">
                <p class="text-secondary">
                    <span class="badge bg-dark me-3 p-3">🧑 Ancien propriétaire</span>
                    <span class="badge bg-success me-3 p-3">👤 Nouveau propriétaire</span>
                    <span class="badge bg-primary p-3">📜 Historique complet</span>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "📜 Historique global - Takalo-takalo", "content" => $content]);
?>
