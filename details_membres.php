<?php
// Inclure les fichiers PHP nécessaire
require_once 'Membre.php'; // Fichier contenant la classe Membre et ses méthodes

// Instancier un objet de la classe Membre pour gérer les membres
$membre = new Membre();

// Récupérer la liste des membres
$listeMembres = $membre->listerMembres();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Système de Gestion des Membres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
<a href="index.php" class="return-link">Retour à la Liste des Membres</a>

    <!-- Liste des membres -->
    <h2>Liste des Membres</h2>
    <br>
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
            <th>Options</th>
            <th>Options</th>
            <th>Options</th>
        </tr>
        <?php foreach ($listeMembres as $membre) { ?>
            <tr>
            <td><?php echo $membre['matricule']; ?></td>
            <td><?php echo $membre['nom']; ?></td>
            <td><?php echo $membre['prenom']; ?></td>
            <td><?php echo $membre['adresse']; ?></td>
            <td><?php echo $membre['telephone']; ?></td>
            <!-- Displaying age range -->
            <td><?php echo $membre['age_min'] . " - " . $membre['age_max']; ?></td>
            <td><?php echo $membre['sexe']; ?></td>
            <td><?php echo $membre['situationMatrimoniale']; ?></td>
            <td><?php echo $membre['statut_designation']; ?></td>
                <!-- Bouton pour voir les détails du membre avec un lien vers details_membres.php -->
                <td><a href="details_membres.php?id=<?php echo $membre['id']; ?>" class="btn btn-primary">Détails</a></td>
                <!-- Bouton pour éditer les données avec un lien vers updatedata.php -->
                <td><a href="modifier_membre.php?id=<?php echo $membre['id']; ?>" class="btn btn-primary">Modifier</a></td>
                <!-- Bouton pour supprimer les données avec un lien vers deletedata.php -->
                <td><a href="supprimer_membre.php?id=<?php echo $membre['id']; ?>" class="btn btn-danger">Supprimer</a></td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
