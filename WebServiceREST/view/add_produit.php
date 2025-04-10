<?php
require '../model/db.php';
require '../model/Produits.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $designation = trim($_POST['designation']);
    $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);
    $description = trim($_POST['description'], FILTER_VALIDATE_FLOAT);


    if (!empty($designation && $prix && $description) !== false) {
        $produit = new Produit($pdo);
        $produit->ajouterProduit($designation, $prix, $description);
        header('Location: index.php');
        exit();
    } else {
        echo "< p style='color: red;'>Veuillez entrer un nom valide et un prix numérique.</>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../script/style.css">
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
                <li class="nav-item"><a class="nav-link" href="../menu2.php">recherche</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center text-success">Ajouter un Produit</h1>
    <form method="post" class="p-4 shadow bg-light rounded">
        <div class="mb-3">
            <label for="designation" class="form-label">designation  :</label>
            <input type="text" name="designation" id="designation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix du produit :</label>
            <input type="number" name="prix" id="prix" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description  :</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
