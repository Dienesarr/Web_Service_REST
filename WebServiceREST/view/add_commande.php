<?php
require '../model/db.php';
require '../model/Commande.php';
require '../model/Produits.php';
require '../model/CommandeProduits.php';

$produit = new Produit($pdo);
$commande = new Commande($pdo);
$produits = $produit->obtenirProduits();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $produit_id = filter_var($_POST['produit_id'], FILTER_VALIDATE_INT);
    $numero = trim(($_POST['numero']), FILTER_VALIDATE_INT);
    $total_commande = filter_var($_POST['total_commande'], FILTER_VALIDATE_FLOAT);
    $quantite = filter_var($_POST['quantite'], FILTER_VALIDATE_INT);  // Nouvelle variable quantite

    // Validation des données
    if ($date && $produit_id && $numero && $total_commande > 0 && $quantite > 0) {
        // Ajouter une commande
        $commande_id = $commande->ajouterCommande($date, $numero, $total_commande);

        // Ajouter les produits à la commande
        $commandeProduit = new CommandeProduit($pdo);
        $commandeProduit->ProduitCommande($commande_id, $produit_id, $total_commande, $quantite); // Ajout de la quantité ici

        // Redirection après ajout
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
    <title>Ajouter une Commande</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../script/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Gestion Commandes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="add_produit.php">Ajouter un Produit</a></li>
                <li class="nav-item"><a class="nav-link" href="add_commande.php">Ajouter une Commande</a></li>
                <li class="nav-item"><a class="nav-link" href="afficheproduit.php">Afficher Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="affichecommande.php">Afficher Commandes</a></li>
                <li class="nav-item"><a class="nav-link" href="../menu2.php">recherche</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center text-primary">Ajouter une Commande</h1>
    <form method="post" class="p-4 shadow bg-light rounded">
        <div class="mb-3">
            <label for="date" class="form-label">Date de la commande :</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="produit_id" class="form-label">Produit :</label>
            <select name="produit_id" id="produit_id" class="form-select" required>
                <?php foreach ($produits as $p): ?>
                    <option value="<?= htmlspecialchars($p['id']) ?>"><?= htmlspecialchars($p['designation']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Numéro :</label>
            <input type="text" name="numero" id="numero" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_commande" class="form-label">Total Commande :</label>
            <input type="number" name="total_commande" id="total_commande" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité :</label>
            <input type="number" name="quantite" id="quantite" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
