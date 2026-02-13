<?php
ob_start();
?>
<style>
    .profil-card {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 40px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .profil-card::before {
        content: "👤";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 12rem;
        opacity: 0.05;
        transform: rotate(10deg);
    }
    
    .avatar-geant {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        font-weight: bold;
        color: white;
        border: 4px solid white;
        box-shadow: 0 0 50px rgba(139,92,246,0.5);
        margin: 0 auto 1.5rem;
    }
    
    .stat-card {
        background: rgba(0,0,0,0.3);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 30px;
        padding: 1.8rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        border-color: #8b5cf6;
        transform: translateY(-5px);
        background: rgba(139,92,246,0.1);
    }
    
    .stat-valeur {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #8b5cf6, #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
    }
    
    .badge-membre {
        background: rgba(16,185,129,0.2);
        border: 1px solid #10b981;
        border-radius: 50px;
        padding: 0.8rem 2rem;
        display: inline-block;
    }
    
    .activite-item {
        background: rgba(0,0,0,0.2);
        border-radius: 20px;
        padding: 1rem;
        margin-bottom: 0.8rem;
        border-left: 5px solid;
        transition: all 0.2s ease;
    }
    
    .activite-item:hover {
        background: rgba(139,92,246,0.1);
        transform: translateX(5px);
    }
</style>

<div class="container">
    <!-- Messages de notification -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 'profile_updated'): ?>
        <div class="alert alert-success alert-dismissible fade show p-4 fs-5 rounded-4 mb-4">
            <span class="me-2">✅</span> Profil mis à jour avec succès !
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <?php if ($_GET['error'] == 'email_exists'): ?>
            <div class="alert alert-danger p-4 fs-5 rounded-4 mb-4">
                <span class="me-2">😅</span> Cet email est déjà utilisé par un autre compte.
            </div>
        <?php elseif ($_GET['error'] == 'missing_fields'): ?>
            <div class="alert alert-danger p-4 fs-5 rounded-4 mb-4">
                <span class="me-2">⚠️</span> Tous les champs sont obligatoires.
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <div class="row">
        <!-- COLONNE GAUCHE - PROFIL -->
        <div class="col-lg-4 mb-4">
            <div class="profil-card text-center">
                <div class="avatar-geant">
                    <?php 
                    $initiales = '';
                    $nom_complet = $utilisateur['nom'] ?? 'Utilisateur';
                    $mots = explode(' ', $nom_complet);
                    foreach ($mots as $mot) {
                        if (!empty($mot)) {
                            $initiales .= strtoupper(substr($mot, 0, 1));
                        }
                    }
                    echo substr($initiales, 0, 2);
                    ?>
                </div>
                
                <h1 class="display-4 fw-bold mb-2 rainbow-text">
                    <?php echo htmlspecialchars($utilisateur['nom'] ?? 'Utilisateur'); ?>
                </h1>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-primary p-3 fs-6 rounded-pill">
                        <i class="bi bi-envelope me-1"></i> <?php echo htmlspecialchars($utilisateur['email'] ?? ''); ?>
                    </span>
                </div>
                
                <div class="badge-membre mb-4">
                    <span class="me-1">📅</span> Membre depuis le <?php echo $membre_depuis ?? date('d/m/Y'); ?>
                </div>
                
                <div class="d-grid gap-2 mt-3">
                    <a href="<?php echo BASE_URL; ?>/mon-profil/edit" class="btn btn-outline-primary btn-lg py-3 fs-4 rounded-pill">
                        <i class="bi bi-pencil-square me-2"></i> Modifier mon profil
                    </a>
                    <a href="<?php echo BASE_URL; ?>/mes-objets" class="btn btn-outline-secondary btn-lg py-3 fs-4 rounded-pill">
                        <i class="bi bi-box me-2"></i> Voir mes objets
                    </a>
                </div>
            </div>
        </div>
        
        <!-- COLONNE DROITE - STATISTIQUES -->
        <div class="col-lg-8">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-valeur"><?php echo $nb_objets ?? 0; ?></div>
                        <div class="fs-4 mt-2">📦 Objets</div>
                        <small class="text-secondary">dans ta collection</small>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-valeur"><?php echo $nb_echanges ?? 0; ?></div>
                        <div class="fs-4 mt-2">🔄 Échanges</div>
                        <small class="text-secondary">réussis</small>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-valeur">⭐ 4.8</div>
                        <div class="fs-4 mt-2">Évaluation</div>
                        <small class="text-secondary">sur 5 étoiles</small>
                    </div>
                </div>
            </div>
            
            <!-- DERNIERS OBJETS -->
            <div class="profil-card mt-4">
                <h3 class="fw-bold mb-4 fs-2">
                    <span class="me-2">��</span> Tes derniers objets
                </h3>
                
                <?php if (empty($objets)): ?>
                    <div class="text-center py-4">
                        <span class="display-4">🕊️</span>
                        <p class="fs-4 mt-3 text-secondary">Tu n'as pas encore ajouté d'objets.</p>
                        <a href="<?php echo BASE_URL; ?>/ajouter-objet" class="btn btn-primary mt-2 px-5 py-3 fs-5 rounded-pill">
                            <span class="me-2">➕</span> Ajouter un objet
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach (array_slice($objets, 0, 3) as $objet): ?>
                            <div class="col-md-4 mb-3">
                                <div class="bg-dark bg-opacity-25 p-3 rounded-4 h-100">
                                    <?php if (!empty($objet['photo_principale'])): ?>
                                        <img src="<?php echo BASE_URL; ?>/public/assets/images/<?php echo $objet['photo_principale']; ?>" 
                                             style="width: 100%; height: 120px; object-fit: cover; border-radius: 15px;"
                                             alt="<?php echo htmlspecialchars($objet['titre']); ?>">
                                    <?php else: ?>
                                        <div class="bg-dark d-flex align-items-center justify-content-center" 
                                             style="height: 120px; border-radius: 15px;">
                                            <span class="display-6"><?php echo $objet['categorie_icone'] ?? '📦'; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <p class="mt-2 fw-bold mb-0 text-truncate"><?php echo htmlspecialchars($objet['titre']); ?></p>
                                    <small class="text-secondary">💰 <?php echo number_format($objet['prix_estimatif'], 0, ',', ' '); ?> €</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <?php if (count($objets) > 3): ?>
                        <div class="text-center mt-3">
                            <a href="<?php echo BASE_URL; ?>/mes-objets" class="text-decoration-none">
                                Voir tous les <?php echo count($objets); ?> objets →
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            
            <!-- ACTIVITÉ RÉCENTE -->
            <div class="profil-card mt-4">
                <h3 class="fw-bold mb-4 fs-2">
                    <span class="me-2">🔄</span> Activité récente
                </h3>
                
                <?php if (empty($echanges)): ?>
                    <div class="text-center py-4">
                        <span class="display-4">😴</span>
                        <p class="fs-4 mt-3 text-secondary">Aucun échange pour l'instant.</p>
                        <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-outline-primary mt-2 px-5 py-3 fs-5 rounded-pill">
                            <span class="me-2">🔍</span> Explorer le catalogue
                        </a>
                    </div>
                <?php else: ?>
                    <div class="activite-list">
                        <?php foreach (array_slice($echanges, 0, 5) as $echange): ?>
                            <div class="activite-item d-flex justify-content-between align-items-center"
                                 style="border-left-color: 
                                    <?php 
                                    switch($echange['statut']) {
                                        case 'accepte': echo '#10b981'; break;
                                        case 'en_attente': echo '#f59e0b'; break;
                                        case 'refuse': echo '#ef4444'; break;
                                        default: echo '#6c757d';
                                    } 
                                    ?>;">
                                <div>
                                    <span class="badge bg-<?php 
                                        echo $echange['statut'] == 'accepte' ? 'success' : 
                                            ($echange['statut'] == 'en_attente' ? 'warning' : 
                                            ($echange['statut'] == 'refuse' ? 'danger' : 'secondary')); 
                                        ?> me-2">
                                        <?php
                                        switch($echange['statut']) {
                                            case 'accepte': echo '✅'; break;
                                            case 'en_attente': echo '⏳'; break;
                                            case 'refuse': echo '❌'; break;
                                            case 'annule': echo '🚫'; break;
                                            default: echo '❓';
                                        }
                                        ?>
                                    </span>
                                    <span class="fw-bold"><?php echo htmlspecialchars($echange['objet_propose_titre']); ?></span>
                                    <span class="mx-2">🔄</span>
                                    <span class="fw-bold"><?php echo htmlspecialchars($echange['objet_demande_titre']); ?></span>
                                </div>
                                <small class="text-secondary">
                                    <?php echo date('d/m/Y', strtotime($echange['created_at'])); ?>
                                </small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="<?php echo BASE_URL; ?>/mes-echanges" class="btn btn-outline-secondary rounded-pill px-5 py-2">
                            Voir tous les échanges
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "👤 Mon profil - Takalo-takalo", "content" => $content]);
?>
