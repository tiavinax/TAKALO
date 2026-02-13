<?php
ob_start();
?>
<style>
    /* ===== BARRE DE RECHERCHE STYLE ===== */
    .search-hero {
        background: linear-gradient(135deg, rgba(109,40,217,0.2), rgba(16,185,129,0.1));
        border-radius: 40px;
        padding: 2.5rem;
        margin-bottom: 3rem;
        border: 2px solid rgba(255,255,255,0.05);
        position: relative;
        overflow: hidden;
    }
    
    .search-hero::before {
        content: "🔍";
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 8rem;
        opacity: 0.1;
        transform: rotate(15deg);
    }
    
    .search-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff, #e0e0ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .search-box {
        background: rgba(0,0,0,0.3);
        border: 2px solid rgba(255,255,255,0.1);
        border-radius: 60px;
        padding: 0.5rem;
        display: flex;
        gap: 0.5rem;
        backdrop-filter: blur(10px);
    }
    
    .search-input {
        flex: 1;
        background: transparent;
        border: none;
        padding: 1.2rem 1.8rem;
        font-size: 1.3rem;
        color: white;
        outline: none;
    }
    
    .search-input::placeholder {
        color: rgba(255,255,255,0.5);
        font-style: italic;
    }
    
    .category-filter {
        min-width: 220px;
        background: rgba(0,0,0,0.5);
        border: 2px solid rgba(255,255,255,0.1);
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        font-size: 1.2rem;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .category-filter:hover {
        border-color: #8b5cf6;
        background: rgba(139,92,246,0.2);
    }
    
    .search-btn {
        background: linear-gradient(45deg, #8b5cf6, #6d28d9);
        border: none;
        border-radius: 50px;
        padding: 1rem 2.5rem;
        font-size: 1.3rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139,92,246,0.5);
    }
    
    .active-filters {
        margin-top: 1rem;
        padding: 0.5rem 1rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .filter-badge {
        background: rgba(139,92,246,0.2);
        border: 1px solid #8b5cf6;
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .clear-filter {
        color: #ef4444;
        text-decoration: none;
        margin-left: 0.5rem;
        font-size: 1.2rem;
    }
    
    .clear-filter:hover {
        color: #ff6b6b;
    }
    
    .result-stats {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.7);
        margin-top: 1rem;
    }
    
    /* ===== GRILLE CATALOGUE ===== */
    .catalogue-emoji-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .objet-card {
        background: rgba(18, 18, 25, 0.95);
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 30px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .objet-card:hover {
        border-color: #8b5cf6;
        transform: translateY(-10px) rotate(1deg);
        box-shadow: 0 20px 40px rgba(139,92,246,0.3);
    }
    
    .objet-card:hover::after {
        content: "✨";
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 4rem;
        opacity: 0.3;
        transform: rotate(20deg);
    }
    
    .categorie-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 30px;
        padding: 0.5rem 1.2rem;
        font-size: 0.95rem;
        z-index: 10;
    }
    
    .prix-sticker {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: linear-gradient(135deg, #ff6b6b, #feca57);
        color: black;
        font-weight: 800;
        padding: 0.6rem 1.2rem;
        border-radius: 50px;
        font-size: 1.2rem;
        transform: rotate(3deg);
        box-shadow: 0 10px 20px rgba(255,107,107,0.3);
        z-index: 10;
        border: 2px solid white;
    }
    
    .empty-catalogue {
        background: rgba(139,92,246,0.1);
        border: 3px dashed #8b5cf6;
        border-radius: 50px;
        padding: 5rem 2rem;
        text-align: center;
    }
    
    /* SUGGESTIONS RAPIDES */
    .quick-searches {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }
    
    .quick-tag {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 30px;
        padding: 0.5rem 1.2rem;
        font-size: 0.95rem;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .quick-tag:hover {
        background: #8b5cf6;
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="container">
    <!-- ===== HERO RECHERCHE ===== -->
    <div class="search-hero">
        <h2 class="search-title">
            🔍 Trouve ton bonheur dans le bazar
        </h2>
        
        <form id="searchForm" method="GET" action="<?php echo BASE_URL; ?>/catalogue">
            <div class="search-box">
                <input type="text" 
                       name="search" 
                       class="search-input" 
                       placeholder="Que cherches-tu ? (ex: guitare, livre, téléphone...)" 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>"
                       autocomplete="off">
                
                <select name="categorie_id" class="category-filter">
                    <option value="">📋 Toutes les catégories</option>
                    <?php foreach ($categories as $cat): ?>
                        <?php if ($cat['nom'] != 'Tous'): ?>
                        <option value="<?php echo $cat['id']; ?>" 
                            <?php echo ($categorie_id == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo $cat['icone'] . ' ' . htmlspecialchars($cat['nom']); ?>
                        </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" class="search-btn">
                    <span class="me-2">🔎</span>
                    Rechercher
                </button>
            </div>
        </form>
        
        <!-- FILTRES ACTIFS -->
        <?php if (!empty($search) || !empty($categorie_id)): ?>
        <div class="active-filters">
            <span class="text-secondary">Filtres actifs :</span>
            
            <?php if (!empty($search)): ?>
            <span class="filter-badge">
                🔍 "<?php echo htmlspecialchars($search); ?>"
                <a href="<?php echo BASE_URL; ?>/catalogue<?php echo $categorie_id ? '?categorie_id='.$categorie_id : ''; ?>" 
                   class="clear-filter">✕</a>
            </span>
            <?php endif; ?>
            
            <?php if (!empty($categorie_id) && $categorie_selectionnee): ?>
            <span class="filter-badge">
                <?php echo $categorie_selectionnee['icone'] . ' ' . htmlspecialchars($categorie_selectionnee['nom']); ?>
                <a href="<?php echo BASE_URL; ?>/catalogue<?php echo $search ? '?search='.urlencode($search) : ''; ?>" 
                   class="clear-filter">✕</a>
            </span>
            <?php endif; ?>
            
            <?php if (!empty($search) || !empty($categorie_id)): ?>
            <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-sm btn-outline-secondary ms-3">
                🧹 Effacer tout
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- STATISTIQUES RÉSULTATS -->
        <div class="result-stats">
            <?php if (!empty($search) || !empty($categorie_id)): ?>
                <span class="badge bg-dark p-3 fs-6">
                    📊 <?php echo count($objets); ?> résultat<?php echo count($objets) > 1 ? 's' : ''; ?> trouvé<?php echo count($objets) > 1 ? 's' : ''; ?>
                </span>
            <?php else: ?>
                <span class="badge bg-dark p-3 fs-6">
                    📦 <?php echo count($objets); ?> objets disponibles
                </span>
            <?php endif; ?>
        </div>
        
        <!-- SUGGESTIONS RAPIDES -->
        <div class="quick-searches">
            <span class="text-secondary">🔥 Recherches populaires :</span>
            <a href="?search=guitare" class="quick-tag">🎸 Guitare</a>
            <a href="?search=iphone" class="quick-tag">📱 iPhone</a>
            <a href="?search=livre" class="quick-tag">📚 Livre</a>
            <a href="?search=casque" class="quick-tag">🎧 Casque</a>
            <a href="?search=appareil photo" class="quick-tag">📷 Appareil photo</a>
            <a href="?categorie_id=2" class="quick-tag">📚 Livres</a>
            <a href="?categorie_id=3" class="quick-tag">🎮 Jeux vidéo</a>
        </div>
    </div>

    <!-- ===== RÉSULTATS CATALOGUE ===== -->
    <?php if (empty($objets)): ?>
        <div class="empty-catalogue my-5">
            <span class="display-1 mb-4">😢</span>
            <h2 class="display-4 fw-bold mb-3">Aucun résultat trouvé</h2>
            <p class="fs-2 text-secondary mb-4">
                <?php if (!empty($search) || !empty($categorie_id)): ?>
                    Essaie avec d'autres mots-clés ou supprime les filtres
                <?php else: ?>
                    Sois le premier à ajouter un objet dans cette catégorie !
                <?php endif; ?>
            </p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="<?php echo BASE_URL; ?>/catalogue" class="btn btn-outline-primary btn-lg px-5 py-3 fs-3 rounded-pill">
                    🧹 Réinitialiser
                </a>
                <a href="<?php echo BASE_URL; ?>/ajouter-objet" class="btn btn-primary btn-lg px-5 py-3 fs-3 rounded-pill">
                    🚀 Ajouter un objet
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="catalogue-emoji-grid">
            <?php foreach ($objets as $objet): ?>
                <div class="objet-card p-0">
                    <!-- BADGE CATÉGORIE -->
                    <div class="categorie-badge">
                        <?php echo $objet['categorie_icone'] ?? '📦'; ?>
                        <span class="ms-1"><?php echo htmlspecialchars($objet['categorie_nom'] ?? 'Autre'); ?></span>
                    </div>
                    
                    <!-- STICKER PRIX -->
                    <div class="prix-sticker">
                        💰 <?php echo number_format($objet['prix_estimatif'], 0, ',', ' '); ?> €
                    </div>
                    
                    <!-- IMAGE OU EMOJI -->
                    <?php if ($objet['photo_principale']): ?>
                        <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $objet['photo_principale']; ?>" 
                             class="card-img-top" alt="<?php echo htmlspecialchars($objet['titre']); ?>"
                             style="height: 250px; object-fit: cover; border-radius: 30px 30px 0 0;">
                    <?php else: ?>
                        <div class="bg-dark d-flex align-items-center justify-content-center" 
                             style="height: 250px; border-radius: 30px 30px 0 0;">
                            <span class="display-1">
                                <?php echo $objet['categorie_icone'] ?? '📦'; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <!-- TITRE -->
                        <h3 class="fw-bold mb-3 fs-2">
                            <?php echo htmlspecialchars($objet['titre']); ?>
                        </h3>
                        
                        <!-- DESCRIPTION COURTE -->
                        <p class="text-secondary mb-3 fs-5">
                            <?php echo nl2br(htmlspecialchars(substr($objet['description'], 0, 80))); ?>...
                        </p>
                        
                        <!-- PROPRIÉTAIRE -->
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="badge bg-dark p-3 fs-6">
                                <span class="me-1">🧑</span>
                                <?php echo htmlspecialchars($objet['proprietaire_nom']); ?>
                            </span>
                            <span class="text-muted">
                                ⭐ 4.8
                            </span>
                        </div>
                        
                        <!-- BOUTON DÉTAIL -->
                        <a href="<?php echo BASE_URL; ?>/objet/<?php echo $objet['id']; ?>" 
                           class="btn btn-outline-primary w-100 py-3 fs-4 rounded-pill">
                            🔮 VOIR LE DÉTAIL
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- PAGINATION (à venir) -->
        <?php if (count($objets) > 12): ?>
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Pagination">
                <ul class="pagination pagination-lg">
                    <li class="page-item disabled">
                        <a class="page-link bg-dark border-secondary" href="#">←</a>
                    </li>
                    <li class="page-item active"><a class="page-link bg-primary border-primary" href="#">1</a></li>
                    <li class="page-item"><a class="page-link bg-dark border-secondary" href="#">2</a></li>
                    <li class="page-item"><a class="page-link bg-dark border-secondary" href="#">3</a></li>
                    <li class="page-item"><a class="page-link bg-dark border-secondary" href="#">→</a></li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
        
        <!-- LÉGENDE -->
        <div class="text-center mt-5 pt-4">
            <p class="text-secondary fs-5">
                <span class="badge bg-dark me-3 p-3">💰 = prix estimatif</span>
                <span class="badge bg-dark me-3 p-3">🏷️ = catégorie</span>
                <span class="badge bg-dark p-3">✨ = coup de cœur</span>
            </p>
        </div>
    <?php endif; ?>
</div>

<script>
    // Animation de la recherche
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-input');
        const searchForm = document.getElementById('searchForm');
        
        // Auto-submit après 1 seconde d'inactivité (optionnel)
        let timeout = null;
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    if (this.value.length >= 2 || this.value.length === 0) {
                        // Décommenter pour recherche automatique
                        // searchForm.submit();
                    }
                }, 1000);
            });
        }
        
        // Effet de focus sur la barre de recherche
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.boxShadow = '0 0 0 4px rgba(139,92,246,0.3)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.boxShadow = 'none';
            });
        }
    });
</script>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "🎪 Catalogue - Takalo-takalo", "content" => $content]);
?>
