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
    public function ajouterMembre($nom, $prenom, $adresse, $telephone, $ageMin, $ageMax, $sexe, $situationMatrimoniale, $libelleStatut) {
        try {
            // Vérifier si la tranche d'âge existe déjà
            $requeteCheckTrancheAge = $this->connexion->prepare("SELECT id FROM trancheAge WHERE age_min = ? AND age_max = ?");
            $requeteCheckTrancheAge->execute([$ageMin, $ageMax]);
            $resultatCheckTrancheAge = $requeteCheckTrancheAge->fetch(PDO::FETCH_ASSOC);
    
            if ($resultatCheckTrancheAge) {
                $idTrancheAge = $resultatCheckTrancheAge['id'];
            } else {
                // Si la tranche d'âge n'existe pas, l'ajouter à la table 'trancheAge'
                $requeteAjouterTrancheAge = $this->connexion->prepare("INSERT INTO trancheAge (age_min, age_max) VALUES (?, ?)");
                $requeteAjouterTrancheAge->execute([$ageMin, $ageMax]);
                $idTrancheAge = $this->connexion->lastInsertId();
            }
    
            // Vérifier si le statut existe déjà
            $requeteCheckStatut = $this->connexion->prepare("SELECT id FROM statut WHERE libelle = ?");
            $requeteCheckStatut->execute([$libelleStatut]);
            $resultatCheckStatut = $requeteCheckStatut->fetch(PDO::FETCH_ASSOC);
    
            if ($resultatCheckStatut) {
                $idStatut = $resultatCheckStatut['id'];
            } else {
                // Si le statut n'existe pas, l'ajouter à la table 'statut'
                $requeteAjouterStatut = $this->connexion->prepare("INSERT INTO statut (libelle) VALUES (?)");
                $requeteAjouterStatut->execute([$libelleStatut]);
                $idStatut = $this->connexion->lastInsertId();
            }
    
            // Insérer le membre avec l'ID de la tranche d'âge et du statut
            $requete = $this->connexion->prepare("INSERT INTO membres (nom, prenom, adresse, telephone, id_trancheage, sexe, situationMatrimoniale, id_statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $requete->execute([$nom, $prenom, $adresse, $telephone, $idTrancheAge, $sexe, $situationMatrimoniale, $idStatut]);
            
            echo "Membre ajouté avec succès.";
        } catch(PDOException $e) {
            echo "Erreur lors de l'ajout du membre : " . $e->getMessage();
        }
    }
    
      

    // Méthode pour récupérer la liste des membres
    public function listerMembres() {
        $requete = $this->connexion->query("SELECT membres.id, membres.nom, membres.prenom, membres.adresse, membres.telephone, membres.situationMatrimoniale, statut.id AS id_statut, membres.sexe, trancheage.id AS id_trancheage 
        FROM membres
        LEFT JOIN statut ON membres.id_statut = statut.id 
        LEFT JOIN trancheage ON membres.id_trancheage = trancheage.id");
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
