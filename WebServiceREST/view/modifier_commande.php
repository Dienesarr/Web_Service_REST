<?php
require '../model/db.php';
require '../model/Commande.php';
require '../model/Produits.php';
require '../model/CommandeProduits.php';

session_start();

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$produit = new Produit($pdo);
$commande = new Commande($pdo);
$commandeProduit = new CommandeProduit($pdo);

// Vérifiez si l'ID de la commande est passé dans l'URL
if (isset($_GET['id'])) {
    $commande_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    // Récupérer les détails de la commande
    $commandeDetails = $commande->obtenirCommandeParId($commande_id);
    $produits = $produit->obtenirProduits(); // Récupérer tous les produits

    // Si la commande n'existe pas, redirigez ou affichez un message d'erreur
    if (!$commandeDetails) {
        $_SESSION['message'] = "Commande non trouvée.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Aucun ID de commande fourni.";
    header("Location: index.php");
    exit();
}

// Gérer la soumission du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $produit_id = filter_var($_POST['produit_id'], FILTER_VALIDATE_INT);
    $quantite = filter_var($_POST['quantite'], FILTER_VALIDATE_INT);

    if ($produit_id && $quantite && $quantite > 0) {
        // Mettre à jour la commande
        $commande->modifierCommande($commande_id, $date);
        $commandeProduit->ProduitCommande($commande_id, $produit_id, $quantite);
        $_SESSION['message'] = "Commande modifiée avec succès.";
        header('Location: index.php');
        exit();
    } else {
        echo "<p style='color: red;'>Veuillez sélectionner un produit valide et une quantité correcte.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier une Commande</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Gestion Commandes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="add_produit.php">Ajouter un Produit</a></li>
                <li class="nav-item"><a class="nav-link" href="add_commande.php">Ajouter une Commande</a></li>
                <li class="nav-item"><a class="nav-link" href="afficheproduit.php">Afficher Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="affichecommande.php">Afficher Commandes</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center text-primary">Modifier une Commande</h1>
    <form method="post" class="p-4 shadow bg-light rounded">
        <div class="mb-3">
            <label for="date" class="form-label">Date de la commande :</label>
            <input type="date" name="date" id="date" class="form-control" value="<?= htmlspecialchars($commandeDetails['date']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="produit_id" class="form-label">Produit :</label>
            <select name="produit_id" id="produit_id" class="form-select" required>
                <?php foreach ($produits as $p): ?>
                    <option value="<?= htmlspecialchars($p['id']) ?>" <?= $p['id'] == $commandeDetails['produit_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité :</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="<?= htmlspecialchars($commandeDetails['quantite']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>