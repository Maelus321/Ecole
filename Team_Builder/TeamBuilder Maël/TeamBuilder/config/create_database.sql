-- Création de la base de données
CREATE DATABASE IF NOT EXISTS teambuilder;
USE teambuilder;

-- Création de la table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    rank VARCHAR(20) NOT NULL DEFAULT 'bronze',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 