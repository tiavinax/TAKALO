<?php
ob_start();
?>
<style>
    /* ===== TIMELINE STYLE ===== */
    .timeline-container {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 40px;
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .timeline-container::before {
        content: "📜";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 12rem;
        opacity: 0.05;
        transform: rotate(-10deg);
    }
    
    .timeline-header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid rgba(255,255,255,0.1);
    }
    
    .objet-preview {
        width: 100px;
        height: 100px;
        border-radius: 20px;
        object-fit: cover;
        border: 3px solid #8b5cf6;
    }
    
    .objet-preview-placeholder {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }
    
    .timeline {
        position: relative;
        padding: 2rem 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 120px;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, #8b5cf6, #10b981);
        border-radius: 4px;
        box-shadow: 0 0 20px rgba(139,92,246,0.5);
    }
    
    .timeline-item {
        position: relative;
        padding-left: 180px;
        margin-bottom: 3rem;
        min-height: 100px;
    }
    
    .timeline-date {
        position: absolute;
        left: 0;
        top: 0;
        width: 100px;
        background: rgba(139,92,246,0.2);
        border: 1px solid #8b5cf6;
        border-radius: 30px;
        padding: 0.8rem;
        text-align: center;
        font-weight: 600;
    }
    
    .timeline-day {
        font-size: 1.8rem;
        line-height: 1;
        color: #8b5cf6;
    }
    
    .timeline-month {
        font-size: 0.9rem;
        text-transform: uppercase;
        opacity: 0.8;
    }
    
    .timeline-bubble {
        background: rgba(0,0,0,0.3);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 30px 30px 30px 0;
        padding: 1.8rem;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .timeline-bubble:hover {
        border-color: #8b5cf6;
        transform: translateX(10px);
        background: rgba(139,92,246,0.1);
    }
    
    .timeline-bubble::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 30px;
        width: 20px;
        height: 20px;
        background: #8b5cf6;
        border-radius: 50%;
        box-shadow: 0 0 30px #8b5cf6;
    }
    
    .transfer-arrow {
        display: inline-block;
        margin: 0 1rem;
        font-size: 1.5rem;
        animation: arrow-pulse 2s infinite;
    }
    
    @keyframes arrow-pulse {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(5px); }
    }
    
    .proprio-badge-actuel {
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 50px;
        padding: 0.8rem 2rem;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(16,185,129,0.3);
    }
    
    .empty-timeline {
        background: rgba(139,92,246,0.1);
        border: 3px dashed #8b5cf6;
        border-radius: 40px;
        padding: 4rem;
        text-align: center;
    }
    
    .first-owner {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 30px;
        padding: 0.5rem 1.5rem;
        display: inline-block;
        font-weight: 600;
        margin-top: 1rem;
    }
    
    .stats-card {
        background: rgba(0,0,0,0.2);
        border-radius: 30px;
        padding: 1.5rem;
        border: 1px solid rgba(255,255,255,0.05);
    }
</style>

<div class="container">
    <!-- ===== HEADER HISTORIQUE ===== -->
    <div class="timeline-container">
        <div class="timeline-header">
            <?php if (!empty($photos) && isset($photos[0])): ?>
                <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $photos[0]['chemin']; ?>" 
                     class="objet-preview" alt="<?php echo htmlspecialchars($objet['titre']); ?>">
            <?php else: ?>
                <div class="objet-preview-placeholder">
                    <?php echo $objet['categorie_icone'] ?? '📦'; ?>
                </div>
            <?php endif; ?>
            
            <div>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <span class="badge bg-primary p-3 fs-6 rounded-pill">
                        <?php echo $objet['categorie_icone'] ?? '📦'; ?> 
                        <?php echo htmlspecialchars($objet['categorie_nom'] ?? 'Autre'); ?>
                    </span>
                    <span class="text-muted">📅 Ajouté le <?php echo date('d/m/Y', strtotime($objet['created_at'])); ?></span>
                </div>
                <h1 class="display-3 fw-bold mb-2 rainbow-text">
                    <?php echo htmlspecialchars($objet['titre']); ?>
                </h1>
                <p class="fs-3 text-secondary">📜 Historique des propriétaires</p>
            </div>
        </div>
        
        <!-- ===== PROPRIÉTAIRE ACTUEL ===== -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="proprio-badge-actuel">
                <span class="display-6">👑</span>
                <span>Propriétaire actuel : <strong><?php echo htmlspecialchars($proprietaire_actuel['nom'] ?? 'Inconnu'); ?></strong></span>
            </div>
            
            <div class="stats-card d-flex gap-4">
                <div class="text-center">
                    <span class="display-6">📋</span>
                    <div class="fw-bold"><?php echo count($historique); ?></div>
                    <small class="text-secondary">échange(s)</small>
                </div>
                <div class="text-center">
                    <span class="display-6">⏳</span>
                    <div class="fw-bold">
                        <?php 
                        $premiere_date = !empty($historique) ? end($historique)['date_echange'] : $objet['created_at'];
                        $jours = floor((time() - strtotime($premiere_date)) / (60 * 60 * 24));
                        echo $jours; 
                        ?>
                    </div>
                    <small class="text-secondary">jours</small>
                </div>
            </div>
        </div>
        
        <!-- ===== TIMELINE ===== -->
        <?php if (empty($historique)): ?>
            <div class="empty-timeline">
                <span class="display-1 mb-4">🌟</span>
                <h2 class="display-4 fw-bold mb-3">Premier propriétaire</h2>
                <p class="fs-2 text-secondary mb-4">
                    Cet objet n'a jamais été échangé !
                </p>
                <div class="first-owner">
                    <span class="me-2">��</span>
                    <?php echo htmlspecialchars($proprietaire_actuel['nom'] ?? 'Utilisateur'); ?> 
                    depuis le <?php echo date('d/m/Y', strtotime($objet['created_at'])); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="timeline">
                <?php 
                $total = count($historique);
                foreach ($historique as $index => $h): 
                    $date = new DateTime($h['date_echange']);
                    $is_last = ($index == $total - 1);
                ?>
                    <div class="timeline-item">
                        <!-- DATE -->
                        <div class="timeline-date">
                            <div class="timeline-day"><?php echo $date->format('d'); ?></div>
                            <div class="timeline-month"><?php echo $date->format('M Y'); ?></div>
                            <div class="small mt-1"><?php echo $date->format('H:i'); ?></div>
                        </div>
                        
                        <!-- BULLE D'HISTORIQUE -->
                        <div class="timeline-bubble">
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <!-- Ancien proprio -->
                                <div class="d-flex align-items-center">
                                    <span class="display-6 me-2">🧑</span>
                                    <div>
                                        <small class="text-secondary">Ancien propriétaire</small>
                                        <div class="fw-bold fs-4">
                                            <?php echo htmlspecialchars($h['ancien_proprietaire_nom']); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Flèche de transfert -->
                                <div class="transfer-arrow">
                                    ➡️
                                </div>
                                
                                <!-- Nouveau proprio -->
                                <div class="d-flex align-items-center">
                                    <span class="display-6 me-2">👤</span>
                                    <div>
                                        <small class="text-secondary">Nouveau propriétaire</small>
                                        <div class="fw-bold fs-4 text-success">
                                            <?php echo htmlspecialchars($h['nouveau_proprietaire_nom']); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Badge premier proprio -->
                                <?php if ($is_last): ?>
                                    <span class="badge bg-warning text-dark ms-3 p-3 fs-6 rounded-pill">
                                        🏁 Premier propriétaire
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Infos complémentaires -->
                            <div class="mt-3 pt-2 border-top border-secondary border-opacity-25">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <span class="me-2">🔄</span>
                                        Échange #<?php echo $h['echange_id']; ?>
                                    </span>
                                    <span class="badge bg-success bg-opacity-25 p-2">
                                        ✅ Échange accepté
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- LÉGENDE -->
            <div class="mt-5 p-4" style="background: rgba(0,0,0,0.2); border-radius: 30px;">
                <div class="row">
                    <div class="col-md-4">
                        <span class="me-2">📌</span> <strong><?php echo $total; ?> transfert(s)</strong> au total
                    </div>
                    <div class="col-md-4">
                        <span class="me-2">👑</span> Propriétaire actuel : <?php echo htmlspecialchars($proprietaire_actuel['nom'] ?? ''); ?>
                    </div>
                    <div class="col-md-4">
                        <span class="me-2">📅</span> Premier dépôt : <?php echo date('d/m/Y', strtotime($objet['created_at'])); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- BOUTON RETOUR -->
        <div class="text-center mt-5">
            <a href="<?php echo BASE_URL; ?>/objet/<?php echo $objet['id']; ?>" class="btn btn-outline-primary btn-lg px-5 py-3 fs-3 rounded-pill">
                <span class="me-2">🔙</span>
                RETOUR À LA FICHE OBJET
            </a>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "📜 Historique - Takalo-takalo", "content" => $content]);
?>
