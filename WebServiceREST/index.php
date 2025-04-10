<?php
require 'model/db.php';
require 'model/Commande.php';
require 'model/Produits.php';
require 'model/CommandeProduits.php';


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="script/style.css">
    <script>
        function confirmation() {
            return confirm("Êtes-vous sûr de vouloir supprimer cette commande ?");
        }
    </script>

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
                    <li class="nav-item"><a class="nav-link" href="view/add_produit.php">Ajouter un Produit</a></li>
                    <li class="nav-item"><a class="nav-link" href="view/add_commande.php">Ajouter une Commande</a></li>
                    <li class="nav-item"><a class="nav-link" href="view/afficheproduit.php">Afficher Produits</a></li>
                    <li class="nav-item"><a class="nav-link" href="view/affichecommande.php">Afficher Commandes</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu2.php">recherche</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>