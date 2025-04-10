<?php
require '../model/db.php';
require '../model/CommandeProduits.php';
$commandeProduit = new CommandeProduit($pdo);
$commandesProduits = $commandeProduit->obtenirCommandesProduits();


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Commandes</title>
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


            <div class="navbar navbar-default">

            </div>
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
        <h1 class="text-center text-primary">NOS PRICIPAUX COMMANDES</h1>


        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>numero</th>
                    <th>produit</th>
                    <th>quantite</th>
                    <th>total_commande</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandesProduits as $cp): ?>
                    <tr>
                        <td><?= htmlspecialchars($cp['commande_id']) ?></td>
                        <td><?= htmlspecialchars($cp['date']) ?></td>
                        <td><?= htmlspecialchars($cp['numero']) ?></td>
                        <td><?= htmlspecialchars($cp['designation']) ?></td>
                        <td><?= htmlspecialchars($cp['quantite']) ?></td>
                        <td><?= htmlspecialchars($cp['total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>