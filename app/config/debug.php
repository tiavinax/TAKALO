<?php
Flight::route('GET /debug/session', function() {
    echo "<h2>Debug Session</h2>";
    echo "<pre>";
    echo "Session ID: " . session_id() . "\n";
    echo "Session status: " . session_status() . "\n";
    print_r($_SESSION);
    echo "</pre>";
    
    echo "<h3>Test de connexion</h3>";
    echo "<p><a href='/login'>Se connecter</a></p>";
    echo "<p><a href='/register'>S'inscrire</a></p>";
    echo "<p><a href='/mes-objets'>Mes objets (nécessite login)</a></p>";
    echo "<p><a href='/debug/logout'>Forcer déconnexion</a></p>";
});

Flight::route('GET /debug/logout', function() {
    session_destroy();
    session_start();
    session_regenerate_id(true);
    echo "<h2>Déconnexion forcée</h2>";
    echo "<p>Session nettoyée. <a href='/'>Retour à l'accueil</a></p>";
});

Flight::route('GET /debug/db', function() {
    echo "<h2>Debug Base de données</h2>";
    
    try {
        $db = Flight::db();
        
        // Utilisateurs
        $stmt = $db->query("SELECT id, nom, email, created_at FROM utilisateurs");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Utilisateurs (" . count($users) . ")</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Créé le</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . htmlspecialchars($user['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td>" . $user['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Objets
        $stmt = $db->query("SELECT o.id, o.titre, o.utilisateur_id, u.nom as proprietaire FROM objets o JOIN utilisateurs u ON o.utilisateur_id = u.id");
        $objets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Objets (" . count($objets) . ")</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Titre</th><th>Propriétaire</th><th>User ID</th></tr>";
        foreach ($objets as $objet) {
            echo "<tr>";
            echo "<td>" . $objet['id'] . "</td>";
            echo "<td>" . htmlspecialchars($objet['titre']) . "</td>";
            echo "<td>" . htmlspecialchars($objet['proprietaire']) . "</td>";
            echo "<td>" . $objet['utilisateur_id'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>Erreur DB: " . $e->getMessage() . "</p>";
    }
});
