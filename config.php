<?php
// Inclusion de la classe Membre
require_once "Membre.php";

// Configuration de la base de données
define('DB_HOST', 'localhost'); // Hôte de la base de données
define('DB_NAME', 'commune_patte_doie'); // Nom de la base de données
define('DB_USER', 'root'); // Nom d'utilisateur de la base de données
define('DB_PASSWORD', 'Sqlobad64'); // Mot de passe de la base de données

// Connexion à la base de données MySQL
try {
    $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}