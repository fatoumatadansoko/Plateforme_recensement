<?php
// Inclure les fichiers PHP nécessaire
require_once 'Membre.php'; // Fichier contenant la classe Membre et ses méthodes

// Instancier un objet de la classe Membre pour gérer les membres
$membre = new Membre();

// Traitement des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le formulaire d'ajout de membre a été soumis
    if (isset($_POST['ajouterMembre'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $trancheAge = $_POST['trancheage'];
        $sexe = $_POST['sexe'];
        $situationMatrimoniale = $_POST['situationMatrimoniale'];
        $statut = $_POST['statut'];
        
        // Définir les variables d'âge minimum et maximum en fonction de la tranche d'âge sélectionnée
        if ($trancheAge == "0-17") {
            $ageMin = 0;
            $ageMax = 17;
        } elseif ($trancheAge == "18-35") {
            $ageMin = 18;
            $ageMax = 35;
        } elseif ($trancheAge == "50- +") {
            $ageMin = 50;
            $ageMax = 100; // Utilisation d'une valeur maximale arbitraire, ajustez selon vos besoins
        }

        // Définir la désignation en fonction du statut sélectionné (ceci est un exemple, ajustez selon vos besoins)
        if ($statut == "Civil") {
            $designation = "Civil";
        } elseif ($statut == "Chef de quartier") {
            $designation = "Chef de quartier";
        } elseif ($statut == "Badiène Gokh") {
            $designation = "Badiène Gokh";
        }

        // Ajouter le nouveau membre
        $membre->ajouterMembre($nom, $prenom, $adresse, $telephone, $ageMin, $ageMax, $sexe, $situationMatrimoniale, $designation);
    }
}

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
    <h1>Système de Gestion des Membres</h1>
<br>
    <!-- Formulaire d'ajout de membre -->
    <h2>Ajouter un Nouveau Membre</h2>
    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required><br><br>
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" required><br><br>
       
        <div class="form-group col-lg-2">
            <label for="trancheage">Tranche d'Âge :</label>
            <select name="trancheage" id="trancheage" class="form-control" required>
            <option>Sélectionner tranche age</option>
            <option value="0-17">Enfant</option>
            <option value="18-35">Adulte</option>
            <option value="50- +">Personne Age</option>
            </select>
        </div><br><br>
        <div class="form-group col-lg-2">
                        <label for="">Sexe :</label>
                        <select name="sexe" id="sexe" class="form-control" required>
                            <option value="">Sélectionner un sexe</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
        </div><br><br>
       <!-- Champ pour la situation matrimoniale de l'habitant -->
       <div class="form-group col-lg-3">
                        <label for="">Situation matrimoniale :</label>
                        <select name="situationMatrimoniale" id="situationMatrimoniale" class="form-control" required>
                            <option value="">Sélectionner une situation matrimoniale</option>
                            <option value="Célibataire">Celibataire</option>
                            <option value="Marié(e)">Marie(e)</option>
                            <option value="Divorcé(e)">Divorce(e)</option>
                            <option value="Veuf/Veuve">Veuf/Veuve</option>
                        </select>
      </div><br><br>
        <!-- Champ pour le statut de l'habitant -->
        <div class="form-group col-lg-2">
            <label for="">Statut :</label>
            <select name="statut" id="statut" class="form-control" required>
            <option value="">Sélectionner un statut</option>
            <option value="Civil">Civil</option>
            <option value="Chef de quartier">Chef de quartier</option>
            <option value="Badiène Gokh">Badiene Gokh</option>
            </select>
        </div><br><br>
        <input type="submit" name="ajouterMembre" value="Ajouter Membre">
    </form>

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
            <th></th>
            <th></th>
            <th></th>
            
        </tr>
        <?php foreach ($listeMembres as $membre) { ?>
            <tr>
            <td><?php echo $membre['matricule']; ?></td>
            <td><?php echo $membre['nom']; ?></td>
            <td><?php echo $membre['prenom']; ?></td>
            <td><?php echo $membre['adresse']; ?></td>
            <td><?php echo $membre['telephone']; ?></td>
            
            
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
