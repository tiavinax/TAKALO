<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    // Construction du DSN
    $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
    
    if (!empty($_ENV['DB_SOCKET'])) {
        $dsn .= ';unix_socket=' . $_ENV['DB_SOCKET'];
    }
    
    $pdo = new PDO(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
    );
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🌱 Connexion réussie ! Ajout des données d'historique...\n";
    
    // Vérifier quels utilisateurs existent
    $stmt = $pdo->query("SELECT id, nom, email FROM utilisateurs");
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "👥 Utilisateurs disponibles :\n";
    foreach ($utilisateurs as $u) {
        echo "   - ID {$u['id']} : {$u['nom']} ({$u['email']})\n";
    }
    
    if (count($utilisateurs) < 2) {
        echo "❌ Pas assez d'utilisateurs pour créer un échange !\n";
        exit;
    }
    
    // Prendre les 2 premiers utilisateurs
    $user1 = $utilisateurs[0]['id'];
    $user2 = $utilisateurs[1]['id'];
    
    echo "✅ Utilisation des utilisateurs $user1 et $user2 pour l'échange\n";
    
    // Vérifier quels objets existent
    $stmt = $pdo->query("SELECT id, titre, utilisateur_id FROM objets");
    $objets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($objets) < 2) {
        echo "❌ Pas assez d'objets pour créer un échange !\n";
        exit;
    }
    
    // Trouver un objet pour chaque utilisateur
    $objet_user1 = null;
    $objet_user2 = null;
    
    foreach ($objets as $objet) {
        if ($objet['utilisateur_id'] == $user1 && !$objet_user1) {
            $objet_user1 = $objet['id'];
        }
        if ($objet['utilisateur_id'] == $user2 && !$objet_user2) {
            $objet_user2 = $objet['id'];
        }
    }
    
    if (!$objet_user1 || !$objet_user2) {
        echo "❌ Pas d'objets pour ces utilisateurs !\n";
        exit;
    }
    
    // Vérifier s'il y a déjà des échanges acceptés
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM echanges WHERE statut = 'accepte'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] == 0) {
        echo "⚠️  Création d'un échange de test...\n";
        echo "   📦 Objet {$objet_user1} (user $user1) ↔ Objet {$objet_user2} (user $user2)\n";
        echo "   👤 Proposé par user $user2\n";
        
        // Créer un échange de test avec les bons IDs
        $stmt = $pdo->prepare("
            INSERT INTO echanges (objet_propose_id, objet_demande_id, propose_par, statut, created_at) 
            VALUES (?, ?, ?, 'accepte', DATE_SUB(NOW(), INTERVAL 7 DAY))
        ");
        
        $stmt->execute([$objet_user1, $objet_user2, $user2]);
        
        $echange_id = $pdo->lastInsertId();
        echo "✅ Échange créé (ID: $echange_id) !\n";
        
        // Ajouter l'historique
        $stmt = $pdo->prepare("
            INSERT INTO historique_proprietaires (objet_id, ancien_proprietaire_id, nouveau_proprietaire_id, echange_id, date_echange)
            VALUES (?, ?, ?, ?, ?)
        ");
        
        // Historique objet 1 : de user1 à user2
        $stmt->execute([$objet_user1, $user1, $user2, $echange_id, date('Y-m-d H:i:s', strtotime('-7 days'))]);
        echo "   ✅ Historique objet $objet_user1 : user$user1 → user$user2\n";
        
        // Historique objet 2 : de user2 à user1
        $stmt->execute([$objet_user2, $user2, $user1, $echange_id, date('Y-m-d H:i:s', strtotime('-7 days'))]);
        echo "   ✅ Historique objet $objet_user2 : user$user2 → user$user1\n";
        
    } else {
        echo "✅ Des échanges existent déjà.\n";
    }
    
    // Afficher le nombre d'historiques
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM historique_proprietaires");
    $hist_count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📊 Nombre d'entrées dans l'historique : " . $hist_count['count'] . "\n";
    
    echo "✅ Données d'historique prêtes !\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "   Code: " . $e->getCode() . "\n";
}
