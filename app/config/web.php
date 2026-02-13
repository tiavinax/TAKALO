<?php
// ================================================
// CHARGEMENT DES CONTRÔLEURS
// ================================================
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ObjetController.php';
require_once __DIR__ . '/../controllers/CatalogueController.php';
require_once __DIR__ . '/../controllers/EchangeController.php';
require_once __DIR__ . '/../controllers/HistoriqueController.php';

// ================================================
// CHARGEMENT DES MODÈLES
// ================================================
require_once __DIR__ . '/../models/UtilisateurModel.php';
require_once __DIR__ . '/../models/ObjetModel.php';
require_once __DIR__ . '/../models/EchangeModel.php';
require_once __DIR__ . '/../models/CategorieModel.php';

// ================================================
// INSTANCIATION DES CONTRÔLEURS
// ================================================
$authController = new AuthController();
$objetController = new ObjetController();
$catalogueController = new CatalogueController();
$echangeController = new EchangeController();
$historiqueController = new HistoriqueController();

// ================================================
// ROUTES
// ================================================

// Route d'accueil
Flight::route('GET /', function() {
    Flight::render('welcome', ['title' => 'Bienvenue sur Takalo-takalo']);
});

// Routes d'authentification
Flight::route('GET /login', [$authController, 'showLogin']);
Flight::route('POST /login', [$authController, 'login']);
Flight::route('GET /register', [$authController, 'showRegister']);
Flight::route('POST /register', [$authController, 'register']);
Flight::route('GET /logout', [$authController, 'logout']);

// Routes objets
Flight::route('GET /mes-objets', [$objetController, 'showMesObjets']);
Flight::route('GET /ajouter-objet', [$objetController, 'showAjouterObjet']);
Flight::route('POST /ajouter-objet', [$objetController, 'ajouterObjet']);
Flight::route('GET /modifier-objet/@id', [$objetController, 'showModifierObjet']);
Flight::route('POST /modifier-objet/@id', [$objetController, 'updateObjet']);
Flight::route('POST /supprimer-objet/@id', [$objetController, 'deleteObjet']);

// Routes catalogue
Flight::route('GET /catalogue', [$catalogueController, 'showCatalogue']);
Flight::route('GET /objet/@id', [$catalogueController, 'showDetailObjet']);
Flight::route('POST /proposer-echange', [$catalogueController, 'proposerEchange']);
Flight::route('GET /api/recherche', [$catalogueController, 'rechercherAjax']);

// Routes échanges
Flight::route('GET /mes-echanges', [$echangeController, 'showMesEchanges']);
Flight::route('POST /accepter-echange/@id', [$echangeController, 'accepterEchange']);
Flight::route('POST /refuser-echange/@id', [$echangeController, 'refuserEchange']);
Flight::route('POST /annuler-echange/@id', [$echangeController, 'annulerEchange']);

// Routes historiques (publiques)
Flight::route('GET /historique/@id', [$historiqueController, 'showHistorique']);

Flight::start();

// ================================================
// ROUTES HISTORIQUE GLOBAL
// ================================================
require_once __DIR__ . '/../controllers/HistoriqueGlobalController.php';
$historiqueGlobalController = new HistoriqueGlobalController();
Flight::route('GET /historique-global', [$historiqueGlobalController, 'showHistoriqueGlobal']);

// ================================================
// HISTORIQUE GLOBAL
// ================================================
require_once __DIR__ . '/../controllers/HistoriqueGlobalController.php';

// Vérifier que la classe existe
if (class_exists('HistoriqueGlobalController')) {
    $historiqueGlobalController = new HistoriqueGlobalController();
    Flight::route('GET /historique-global', [$historiqueGlobalController, 'showHistoriqueGlobal']);
    error_log("✅ Route /historique-global enregistrée");
} else {
    error_log("❌ Classe HistoriqueGlobalController non trouvée");
}

// ================================================
// ROUTES PROFIL
// ================================================
require_once __DIR__ . '/../controllers/ProfilController.php';
$profilController = new ProfilController();

Flight::route('GET /mon-profil', [$profilController, 'showProfil']);
Flight::route('GET /mon-profil/edit', [$profilController, 'showEditProfil']);
Flight::route('POST /mon-profil/update', [$profilController, 'updateProfil']);

// ================================================
// ROUTES PROFIL (FORCER L'ORDRE)
// ================================================
require_once __DIR__ . '/../controllers/ProfilController.php';
$profilController = new ProfilController();

Flight::route('GET /mon-profil', [$profilController, 'showProfil']);
Flight::route('GET /mon-profil/edit', [$profilController, 'showEditProfil']);
Flight::route('POST /mon-profil/update', [$profilController, 'updateProfil']);
