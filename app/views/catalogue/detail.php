<?php
ob_start();
?>
<<<<<<< HEAD
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
=======
<style>
    .detail-gallery {
        background: rgba(0,0,0,0.3);
        border-radius: 40px;
        padding: 1rem;
        border: 2px solid rgba(255,255,255,0.05);
    }
    
    .proprio-profile {
        background: rgba(139, 92, 246, 0.1);
        border-radius: 100px;
        padding: 1.5rem;
        border: 1px solid rgba(139, 92, 246, 0.3);
    }
    
    .echange-card {
        background: linear-gradient(135deg, rgba(109,40,217,0.2), rgba(16,185,129,0.1));
        border: 2px solid rgba(255,255,255,0.05);
        border-radius: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .echange-card::after {
        content: "🔄";
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 8rem;
        opacity: 0.1;
        transform: rotate(20deg);
    }
    
    .specs-badge {
        background: rgba(0,0,0,0.3);
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid rgba(255,255,255,0.1);
    }
</style>

<div class="container">
    <!-- Fil d'Ariane fun -->
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb fs-4">
            <li class="breadcrumb-item">
                <a href="<?php echo BASE_URL; ?>/catalogue" class="text-decoration-none">
                    <span class="me-1">🎪</span> Catalogue
                </a>
            </li>
            <li class="breadcrumb-item active fw-bold" aria-current="page">
                <?php echo htmlspecialchars($objet['titre']); ?>
            </li>
        </ol>
    </nav>
    
    <div class="row g-5">
        <!-- COLONNE GAUCHE - GALERIE -->
        <div class="col-lg-7">
            <div class="detail-gallery">
                <?php if (!empty($photos)): ?>
                    <div id="carouselObjet" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-4">
                            <?php foreach ($photos as $index => $photo): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $photo['chemin']; ?>" 
                                         class="d-block w-100" 
                                         alt="<?php echo htmlspecialchars($objet['titre']); ?>"
                                         style="height: 500px; object-fit: contain; background: rgba(0,0,0,0.5);">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($photos) > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselObjet" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Précédent</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselObjet" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Suivant</span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 500px; border-radius: 20px;">
                        <div class="text-center">
                            <span class="display-1 mb-3">📸</span>
                            <p class="fs-3 text-secondary">Aucune photo dispo</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- PETITES INFOS DRÔLES -->
            <div class="d-flex gap-3 mt-4 flex-wrap">
                <span class="specs-badge">
                    <span class="display-6">📏</span> Taille: Normale
                </span>
                <span class="specs-badge">
                    <span class="display-6">⚖️</span> Poids: Pas trop lourd
                </span>
                <span class="specs-badge">
                    <span class="display-6">🔋</span> État: Impeccable
                </span>
                <span class="specs-badge">
                    <span class="display-6">🎨</span> Couleur: Magnifique
                </span>
            </div>
        </div>
        
        <!-- COLONNE DROITE - INFOS -->
        <div class="col-lg-5">
            <!-- BADGE PRIX GÉANT -->
            <div class="d-inline-block mb-4">
                <span class="badge bg-warning text-dark p-4 fs-2 rounded-pill shadow-lg" 
                      style="transform: rotate(-2deg);">
                    💰�� <?php echo $objet['prix_estimatif']; ?> € 💰💰
                </span>
            </div>
            
            <!-- TITRE AVEC EMOJIS -->
            <h1 class="display-2 fw-bold mb-4">
                <?php 
                $icones = ['✨', '🔥', '💎', '⭐', '💫', '⚡'];
                echo $icones[array_rand($icones)] . ' ';
                ?>
                <?php echo htmlspecialchars($objet['titre']); ?>
            </h1>
            
            <!-- PROFIL PROPRIO -->
            <div class="proprio-profile d-flex align-items-center gap-4 mb-5">
                <div class="display-1">
                    <?php 
                    $avatars = ['🧑‍🎤', '👨‍🎨', '🧑‍🚀', '👩‍🔬', '��‍🏫', '👩‍🎓'];
                    echo $avatars[array_rand($avatars)];
                    ?>
                </div>
                <div>
                    <p class="fs-4 mb-1">
                        <span class="fw-bold">Proposé par</span><br>
                        <span class="display-6"><?php echo htmlspecialchars($objet['proprietaire_nom']); ?></span>
                    </p>
                    <div class="mt-2">
                        
                    </div>
                </div>
            </div>
            
            <!-- DESCRIPTION -->
            <div class="mb-5">
                <h3 class="fw-bold mb-4 fs-1">
                    <span class="me-2">📝</span> Description
                </h3>
                <div class="bg-dark p-4 rounded-4" style="background: rgba(0,0,0,0.3);">
                    <p class="fs-4 lh-lg">
                        <?php echo nl2br(htmlspecialchars($objet['description'])); ?>
                    </p>
                </div>
            </div>
            
            <!-- CARTE D'ÉCHANGE -->
            <?php if (!empty($mesObjets)): ?>
                <div class="echange-card p-5">
                    <h3 class="fw-bold mb-4 fs-1">
                        <span class="me-2">🔄</span> Proposer un échange
                    </h3>
                    
                    <form id="proposerEchangeForm">
                        <input type="hidden" name="objet_demande_id" value="<?php echo $objet['id']; ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fs-4 mb-3">
                                <span class="me-2">🎁</span> Choisis ton objet à échanger :
                            </label>
                            <select class="form-select form-select-lg p-4 fs-4 rounded-pill" 
                                    id="objet_propose_id" name="objet_propose_id" required>
                                <option value="" selected disabled>-- Sélectionne un objet --</option>
                                <?php foreach ($mesObjets as $monObjet): ?>
                                    <option value="<?php echo $monObjet['id']; ?>">
                                        <?php 
                                        $emoji = ['📦', '🎮', '📚', '👕', '💻', '🎸'];
                                        echo $emoji[array_rand($emoji)] . ' ';
                                        ?>
                                        <?php echo htmlspecialchars($monObjet['titre']); ?> 
                                        (💰 <?php echo $monObjet['prix_estimatif']; ?> €)
                                    </option>
>>>>>>> b-tiavina1
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
<<<<<<< HEAD
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
=======
                        <button type="submit" class="btn btn-success w-100 py-4 fs-2 rounded-pill shadow-lg"
                                style="background: linear-gradient(45deg, #10b981, #059669);">
                            <span class="me-2">🤝</span>
                            PROPOSER L'ÉCHANGE
                            <span class="ms-2">⚡</span>
                        </button>
                    </form>
                    
                    <p class="text-secondary mt-4 fs-5 text-center">
                        <span class="me-1">��</span> 
                        Une fois accepté, les objets changent direct de proprio !
                    </p>
                </div>
            <?php else: ?>
                <div class="bg-warning bg-opacity-10 p-5 rounded-5 text-center border border-warning border-2">
                    <span class="display-2 mb-3">😱</span>
                    <h3 class="fw-bold mb-3">Aucun objet à échanger !</h3>
                    <p class="fs-4 mb-4">Il te faut au moins un objet pour proposer un échange.</p>
                    <a href="<?php echo BASE_URL; ?>/ajouter-objet" class="btn btn-warning btn-lg px-5 py-3 fs-3 rounded-pill">
                        <span class="me-2">🚀</span>
                        AJOUTER UN OBJET
                    </a>
                </div>
>>>>>>> b-tiavina1
            <?php endif; ?>
        </div>
    </div>
</div>

<<<<<<< HEAD
<?php
$content = ob_get_clean();
$scripts = '
<script>
document.getElementById("proposerEchangeForm").addEventListener("submit", function(e) {
=======
<script>
document.getElementById("proposerEchangeForm")?.addEventListener("submit", function(e) {
>>>>>>> b-tiavina1
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
<<<<<<< HEAD
    fetch("' . BASE_URL . '/proposer-echange", {
=======
    fetch("<?php echo BASE_URL; ?>/proposer-echange", {
>>>>>>> b-tiavina1
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
<<<<<<< HEAD
            alert(data.message);
            window.location.href = "' . BASE_URL . '/mes-echanges";
        } else {
            alert(data.error);
=======
            alert("🎉 Super ! Ta proposition d'échange a été envoyée !");
            window.location.href = "<?php echo BASE_URL; ?>/mes-echanges";
        } else {
            alert("😅 " + data.error);
>>>>>>> b-tiavina1
        }
    })
    .catch(error => {
        console.error("Error:", error);
<<<<<<< HEAD
        alert("Une erreur est survenue");
    });
});
</script>
';

Flight::render("layout", ["title" => $objet['titre'], "content" => $content, "scripts" => $scripts]);
=======
        alert("😱 Une erreur est survenue... Réessaie !");
    });
});
</script>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => $objet['titre'] . " - Takalo-takalo", "content" => $content]);
?>

                    <!-- LIEN HISTORIQUE -->
                    <div class="mt-4 p-4" style="background: rgba(0,0,0,0.2); border-radius: 20px;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="display-6 me-3">📜</span>
                                <span class="fs-3 fw-bold">Historique de l'objet</span>
                                <p class="text-secondary fs-5 mt-2 mb-0">
                                    Vois qui a possédé cet objet avant !
                                </p>
                            </div>
                            <a href="<?php echo BASE_URL; ?>/historique/<?php echo $objet['id']; ?>" 
                               class="btn btn-outline-info btn-lg px-5 py-3 fs-4 rounded-pill">
                                VOIR L'HISTORIQUE
                                <span class="ms-2">→</span>
                            </a>
                        </div>
                    </div>
>>>>>>> b-tiavina1
