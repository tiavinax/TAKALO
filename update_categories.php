<?php
// Utiliser la même configuration que le reste de l'application
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/config.php';

try {
    // Récupérer la connexion PDO depuis Flight
    $pdo = Flight::db();
    
    echo "✅ Connexion à la base de données réussie !\n";
    
    // 1. Vérifier si la table categories existe
    $stmt = $pdo->query("SHOW TABLES LIKE 'categories'");
    if ($stmt->rowCount() == 0) {
        echo "📦 Création de la table categories...\n";
        
        $sql = "CREATE TABLE categories (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nom VARCHAR(50) UNIQUE NOT NULL,
            icone VARCHAR(30) DEFAULT '📦',
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $pdo->exec($sql);
        
        // Insertion des catégories
        $sql = "INSERT INTO categories (nom, icone, description) VALUES
            ('Tous', '🔍', 'Toutes les catégories'),
            ('Livres', '��', 'Romans, BD, mangas, essais...'),
            ('Jeux vidéo', '🎮', 'Consoles, jeux, accessoires'),
            ('Instruments', '🎸', 'Guitares, pianos, batterie...'),
            ('Smartphones', '📱', 'Téléphones et accessoires'),
            ('Ordinateurs', '💻', 'PC, Mac, tablettes'),
            ('Audio', '🎧', 'Casques, enceintes, micros'),
            ('Vêtements', '👕', 'T-shirts, vestes, jeans...'),
            ('Chaussures', '👟', 'Baskets, bottes, sandales'),
            ('Accessoires', '🕶️', 'Montres, lunettes, bijoux'),
            ('Photo', '📷', 'Appareils, objectifs'),
            ('Jouets', '🧸', 'Jeux, peluches, figurines'),
            ('Meubles', '🪑', 'Tables, chaises, étagères'),
            ('Électroménager', '🔌', 'Petit électroménager'),
            ('Autre', '��', 'Objets divers')";
        $pdo->exec($sql);
        
        echo "✅ Table categories créée avec succès\n";
    } else {
        echo "✅ Table categories déjà existante\n";
    }
    
    // 2. Vérifier si la colonne categorie_id existe dans objets
    $stmt = $pdo->query("SHOW COLUMNS FROM objets LIKE 'categorie_id'");
    if ($stmt->rowCount() == 0) {
        echo "📦 Ajout de la colonne categorie_id...\n";
        $pdo->exec("ALTER TABLE objets ADD COLUMN categorie_id INT DEFAULT 1");
        
        // Vérifier si la clé étrangère existe déjà
        try {
            $pdo->exec("ALTER TABLE objets ADD FOREIGN KEY (categorie_id) REFERENCES categories(id)");
        } catch (Exception $e) {
            echo "ℹ️ La clé étrangère existe peut-être déjà\n";
        }
        
        echo "✅ Colonne categorie_id ajoutée\n";
    } else {
        echo "✅ Colonne categorie_id déjà existante\n";
    }
    
    // 3. Mettre à jour les objets sans catégorie
    $stmt = $pdo->prepare("UPDATE objets SET categorie_id = 1 WHERE categorie_id IS NULL OR categorie_id = 0");
    $stmt->execute();
    $count = $stmt->rowCount();
    echo "✅ $count objets mis à jour avec la catégorie par défaut\n";
    
    // 4. Vérifier les objets et leur catégorie
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM objets");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM objets WHERE categorie_id = 1");
    $defaut = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "\n📊 RÉCAPITULATIF :\n";
    echo "   - Total objets : $total\n";
    echo "   - Catégorie par défaut : $defaut\n";
    echo "   - Autres catégories : " . ($total - $defaut) . "\n";
    
    // 5. Afficher les catégories disponibles
    echo "\n📋 LISTE DES CATÉGORIES :\n";
    $stmt = $pdo->query("SELECT id, icone, nom FROM categories ORDER BY id");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($categories as $cat) {
        echo "   {$cat['id']}. {$cat['icone']} {$cat['nom']}\n";
    }
    
    echo "\n✨ Mise à jour terminée avec succès !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "\n💡 Astuce : Vérifie que :\n";
    echo "   1. Le fichier .env existe à la racine\n";
    echo "   2. Les paramètres de connexion sont corrects\n";
    echo "   3. MySQL est bien lancé\n";
}
