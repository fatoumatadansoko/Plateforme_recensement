<?php
// Assurez-vous que l'identifiant du membre à afficher est spécifié dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Rediriger vers la page principale si l'identifiant est manquant
    header("Location: index.php");
    exit;
}

// Inclure le fichier PHP contenant la classe Membre et ses méthodes
require_once 'Membre.php';

// Instancier un objet de la classe Membre pour gérer les membres
$membre = new Membre();

// Récupérer l'identifiant du membre à afficher à partir de l'URL
$idMembre = $_GET['id'];

// Récupérer les détails du membre spécifique
$detailsMembre = $membre->getDetailsMembre($idMembre);

// Vérifier si le membre existe
if (!$detailsMembre) {
    // Rediriger vers la page principale si le membre n'existe pas
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Membre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<a href="index.php" class="return-link">Retour à la Liste des Membres</a>

    <h2>Détails du Membre</h2>
    <br><br>
    <table>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Tranche d'Âge</th>
            <th>Sexe</th>
            <th>Situation Matrimoniale</th>
            <th>Statut</th>
        </tr>
        <tr>
            <td><?php echo $detailsMembre['matricule']; ?></td>
            <td><?php echo $detailsMembre['nom']; ?></td>
            <td><?php echo $detailsMembre['prenom']; ?></td>
            <td><?php echo $detailsMembre['adresse']; ?></td>
            <td><?php echo $detailsMembre['telephone']; ?></td>
            <!-- Displaying age range -->
            <td><?php echo $detailsMembre['age_min'] . " - " . $detailsMembre['age_max']; ?></td>
            <td><?php echo $detailsMembre['sexe']; ?></td>
            <td><?php echo $detailsMembre['situationMatrimoniale']; ?></td>
            <td><?php echo $detailsMembre['designation']; ?></td>
        </tr>
    </table>

</body>
</html>
