<?php
// Inclure les fichiers PHP nécessaires
require_once 'Membre.php'; // Fichier contenant la classe Membre et ses méthodes

// Vérifier si l'identifiant du membre à modifier est spécifié dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Rediriger vers la page principale si l'identifiant est manquant
    header("Location: index.php");
    exit;
}

// Récupérer l'identifiant du membre à modifier
$id = $_GET['id'];

// Instancier un objet de la classe Membre pour gérer les membres
$membre = new Membre();

// Récupérer les informations du membre à modifier
$infoMembre = $membre->getDetailsMembre($id);

// Vérifier si les informations du membre ont été récupérées avec succès
if (!$infoMembre) {
    // Rediriger vers la page principale si les informations du membre sont introuvables
    header("Location: index.php");
    exit;
}

// Traitement des données du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire de modification
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $trancheAge = $_POST['trancheage'];
    $sexe = $_POST['sexe'];
    $situationMatrimoniale = $_POST['situationMatrimoniale'];
    $statut = $_POST['statut'];
    
    // Modifier les informations du membre
    $membre->modifierMembre($id, $nom, $prenom, $adresse, $telephone, $ageMin, $ageMax, $sexe, $situationMatrimoniale, $designation);


    // Rediriger vers la page principale après la modification
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Membre</title>
    <link rel="stylesheet" href="mod.css">
</head>
<body>
<a href="index.php" class="return-link">Retour à la Liste des Membres</a>
<br>
<h1>Modifier Membre</h1>

<!-- Formulaire de modification de membre -->
<form class="modification-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo $infoMembre['nom']; ?>" required><br><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo $infoMembre['prenom']; ?>" required><br><br>

    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" value="<?php echo $infoMembre['adresse']; ?>" required><br><br>

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="<?php echo $infoMembre['telephone']; ?>" required><br><br>

    <label for="trancheage">Tranche d'Âge :</label>
    <select id="trancheage" name="trancheage" required>
        <option value="0-17" <?php if ($infoMembre['age_min'] == 0 && $infoMembre['age_max'] == 17) echo 'selected'; ?>>Enfant</option>
        <option value="18-35" <?php if ($infoMembre['age_min'] == 18 && $infoMembre['age_max'] == 35) echo 'selected'; ?>>Adulte</option>
        <option value="50- +" <?php if ($infoMembre['age_min'] == 50 && $infoMembre['age_max'] == 100) echo 'selected'; ?>>Personne Agée</option>
    </select><br><br>

    <label for="sexe">Sexe :</label>
    <select id="sexe" name="sexe" required>
        <option value="Homme" <?php if ($infoMembre['sexe'] == 'Homme') echo 'selected'; ?>>Homme</option>
        <option value="Femme" <?php if ($infoMembre['sexe'] == 'Femme') echo 'selected'; ?>>Femme</option>
    </select><br><br>

    <label for="situationMatrimoniale">Situation Matrimoniale :</label>
    <select id="situationMatrimoniale" name="situationMatrimoniale" required>
        <option value="Célibataire" <?php if ($infoMembre['situationMatrimoniale'] == 'Célibataire') echo 'selected'; ?>>Célibataire</option>
        <option value="Marié(e)" <?php if ($infoMembre['situationMatrimoniale'] == 'Marié(e)') echo 'selected'; ?>>Marié(e)</option>
        <option value="Divorcé(e)" <?php if ($infoMembre['situationMatrimoniale'] == 'Divorcé(e)') echo 'selected'; ?>>Divorcé(e)</option>
        <option value="Veuf/Veuve" <?php if ($infoMembre['situationMatrimoniale'] == 'Veuf/Veuve') echo 'selected'; ?>>Veuf/Veuve</option>
    </select><br><br>

    <label for="statut">Statut :</label>
    <select id="statut" name="statut" required>
        <option value="Civil" <?php if ($infoMembre['designation'] == 'Civil') echo 'selected'; ?>>Civil</option>
        <option value="Chef de quartier" <?php if ($infoMembre['designation'] == 'Chef de quartier') echo 'selected'; ?>>Chef de quartier</option>
        <option value="Badiène Gokh" <?php if ($infoMembre['designation'] == 'Badiène Gokh') echo 'selected'; ?>>Badiène Gokh</option>
    </select><br><br>

    <input type="submit" value="Modifier Membre">
</form>

</body>
</html>
