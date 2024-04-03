<?php
// Inclure les fichiers PHP nécessaires
require_once 'Membre.php'; // Fichier contenant la classe Membre et ses méthodes

// Vérifier si l'identifiant du membre à modifier est spécifié dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Rediriger vers la page principale si l'identifiant est manquant
    header("Location: index.php");
    exit;
}

// Instancier un objet de la classe Membre pour gérer les membres
$membre = new Membre();

// Récupérer l'identifiant du membre à modifier
$idMembre = $_GET['id'];

// Récupérer les informations du membre à modifier
$infoMembre = $membre->getMembre($idMembre);

// Traitement des données du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $trancheAge = $_POST['trancheAge'];
    $sexe = $_POST['sexe'];
    $situationMatrimoniale = $_POST['situationMatrimoniale'];
    $statut = $_POST['statut'];

    // Modifier les informations du membre
    $membre->modifierMembre($idMembre, $nom, $prenom, $adresse, $telephone, $trancheAge, $sexe, $situationMatrimoniale, $statut);

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
    <form class="modification-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idMembre); ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $infoMembre['nom']; ?>" required><br><br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $infoMembre['prenom']; ?>" required><br><br>
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" value="<?php echo $infoMembre['adresse']; ?>" required><br><br>
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="<?php echo $infoMembre['telephone']; ?>" required><br><br>
        <label for="trancheAge">Tranche d'Âge :</label>
        <input type="text" id="trancheAge" name="trancheAge" value="<?php echo $infoMembre['trancheAge']; ?>" required><br><br>
        <label for="sexe">Sexe :</label>
        <input type="text" id="sexe" name="sexe" value="<?php echo $infoMembre['sexe']; ?>" required><br><br>
        <label for="situationMatrimoniale">Situation Matrimoniale :</label>
        <input type="text" id="situationMatrimoniale" name="situationMatrimoniale" value="<?php echo $infoMembre['situationMatrimoniale']; ?>" required><br><br>
        <label for="statut">Statut :</label>
        <input type="text" id="statut" name="statut" value="<?php echo $infoMembre['statut']; ?>" required><br><br>
        <input type="submit" value="Modifier Membre">
    </form>
</body>
</html>
