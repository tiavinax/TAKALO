-- Création de la base de données
-- CREATE DATABASE IF NOT EXISTS takalo_takalo;
-- USE takalo_takalo;

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des objets
CREATE TABLE objets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    prix_estimatif DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Table des photos d'objets
CREATE TABLE photos_objet (
    id INT PRIMARY KEY AUTO_INCREMENT,
    objet_id INT NOT NULL,
    chemin VARCHAR(255) NOT NULL,
    est_principale BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (objet_id) REFERENCES objets(id) ON DELETE CASCADE
);

-- Table des échanges
CREATE TABLE echanges (
    id INT PRIMARY KEY AUTO_INCREMENT,
    objet_propose_id INT NOT NULL,
    objet_demande_id INT NOT NULL,
    propose_par INT NOT NULL,
    statut ENUM('en_attente', 'accepte', 'refuse', 'annule') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (objet_propose_id) REFERENCES objets(id),
    FOREIGN KEY (objet_demande_id) REFERENCES objets(id),
    FOREIGN KEY (propose_par) REFERENCES utilisateurs(id)
);


-- Insérer des utilisateurs de test
INSERT INTO utilisateurs (nom, email, password) VALUES 
('Jean Dupont', 'jean@example.com', '1234'),\
('Marie Martin', 'marie@example.com', '5678'),
('Pierre Durand', 'pierre@example.com', '91011');

-- Insérer des objets
INSERT INTO objets (utilisateur_id, titre, description, prix_estimatif) VALUES
(1, 'Livre "Le Petit Prince"', 'Livre en bon état, édition originale', 15.00),
(1, 'Veste en cuir', 'Veste en cuir noir taille M, peu portée', 80.00),
(2, 'Smartphone Samsung', 'Samsung Galaxy S10, écran 6.1", 128Go', 300.00),
(2, 'Casque audio Sony', 'Casque sans fil Sony WH-1000XM3', 200.00),
(3, 'Appareil photo Canon', 'Canon EOS 700D avec objectif 18-55mm', 450.00),
(3, 'Guitare acoustique', 'Guitare Yamaha F310, état neuf', 180.00);

-- Insérer des photos
INSERT INTO photos_objet (objet_id, chemin, est_principale) VALUES
(1, 'livre_petit_prince.jpg', 1),
(2, 'veste_cuir.jpg', 1),
(3, 'samsung_s10.jpg', 1),
(4, 'casque_sony.jpg', 1),
(5, 'canon_eos.jpg', 1),
(6, 'guitare_yamaha.jpg', 1);

            -- CHANGEMENT TIAVINA (9 FEV 2026 - 16:46)
    -- Table des catégories (pour le backoffice)
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ajouter categorie_id à la table objets
ALTER TABLE objets ADD COLUMN categorie_id INT DEFAULT NULL;
ALTER TABLE objets ADD FOREIGN KEY (categorie_id) REFERENCES categories(id);

-- Table historique des échanges (pour tracer la propriété)
CREATE TABLE historique_echanges (
    id INT PRIMARY KEY AUTO_INCREMENT,
    objet_id INT NOT NULL,
    ancien_proprietaire_id INT NOT NULL,
    nouveau_proprietaire_id INT NOT NULL,
    echange_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (objet_id) REFERENCES objets(id),
    FOREIGN KEY (ancien_proprietaire_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (nouveau_proprietaire_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (echange_id) REFERENCES echanges(id)
);

CREATE TABLE administrateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin par défaut
INSERT INTO administrateurs (username, password, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@takalo.com');



