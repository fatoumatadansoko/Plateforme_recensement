<?php
// Inclure les fichiers PHP nécessaires
require_once 'Membre.php'; // Fichier contenant la classe Membre et ses méthodes

// Vérifier si l'identifiant du membre à supprimer est spécifié dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Rediriger vers la page principale si l'identifiant est manquant
    header("Location: index.php");
    exit;
}

// Instancier un objet de la classe Membre pour gérer les membres
$membre = new Membre();

// Récupérer l'identifiant du membre à supprimer
$idMembre = $_GET['id'];

// Vérifier si le formulaire de confirmation de suppression a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'utilisateur a confirmé la suppression
    if (isset($_POST['confirmSuppression'])) {
        // Supprimer le membre de la base de données
        $membre->supprimerMembre($idMembre);

        // Rediriger vers la page principale après la suppression
        header("Location: index.php");
        exit;
    } else {
        // Rediriger vers la page principale si l'utilisateur annule la suppression
        header("Location: index.php");
        exit;
    }
}

// Récupérer les informations du membre à partir de l'identifiant
$infoMembre = $membre->getDetailsMembre($idMembre);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer Membre</title>
    <link rel="stylesheet" href="sup.css">
</head>
<body>
    <h1>Supprimer Membre</h1>

    <!-- Afficher les informations du membre à supprimer -->
    <p class="confirmation-message">Êtes-vous sûr de vouloir supprimer le membre suivant ?</p>
    <p><strong>Nom :</strong> <?php echo $infoMembre['nom']; ?></p>
    <p><strong>Prénom :</strong> <?php echo $infoMembre['prenom']; ?></p>
    <p><strong>Adresse :</strong> <?php echo $infoMembre['adresse']; ?></p>
    <p><strong>Téléphone :</strong> <?php echo $infoMembre['telephone']; ?></p>

    <!-- Formulaire de confirmation de suppression -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idMembre); ?>">
        <input type="submit" name="confirmSuppression" value="Confirmer Suppression">
        <input type="button" value="Annuler" onclick="window.location.href='index.php';">
    </form>

    
</body>
</html>