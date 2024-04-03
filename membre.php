<?php
require_once 'config.php';
class Membre {
    private $connexion;

    
    // Constructeur pour initialiser la connexion à la base de données
    public function __construct() {
        $host = 'localhost'; // Hôte de la base de données
        $db = 'commune_patte_doie'; // Nom de la base de données
        $user = 'root'; // Nom d'utilisateur de la base de données
        $password = 'Sqlobad64'; // Mot de passe de la base de données

        // Connexion à la base de données MySQL
        try {
            $this->connexion = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }

    // Méthode pour ajouter un nouveau membre
    public function ajouterMembre($nom, $prenom, $adresse, $telephone, $trancheAge, $sexe, $situationMatrimoniale, $statut) {
        $requete = $this->connexion->prepare("INSERT INTO membres (nom, prenom, adresse, telephone, trancheAge, sexe, situationMatrimoniale, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $requete->execute([$nom, $prenom, $adresse, $telephone, $trancheAge, $sexe, $situationMatrimoniale, $statut]);
    }

    // Méthode pour récupérer la liste des membres
    public function listerMembres() {
        $requete = $this->connexion->query("SELECT * FROM membres");
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les informations d'un membre spécifique
    public function getMembre($id) {
        $requete = $this->connexion->prepare("SELECT * FROM membres WHERE id = ?");
        $requete->execute([$id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour modifier les informations d'un membre
    public function modifierMembre($id, $nom, $prenom, $adresse, $telephone, $trancheAge, $sexe, $situationMatrimoniale, $statut) {
        $requete = $this->connexion->prepare("UPDATE membres SET nom = ?, prenom = ?, adresse = ?, telephone = ?, trancheAge = ?, sexe = ?, situationMatrimoniale = ?, statut = ? WHERE id = ?");
        $requete->execute([$nom, $prenom, $adresse, $telephone, $trancheAge, $sexe, $situationMatrimoniale, $statut, $id]);
    }

    // Méthode pour supprimer un membre
    public function supprimerMembre($id) {
        $requete = $this->connexion->prepare("DELETE FROM membres WHERE id = ?");
        $requete->execute([$id]);
    }
}