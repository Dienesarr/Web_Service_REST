<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix des Webservices</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 0px;
            margin-top: -26px;
            text-align: center;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 10px 12px; /* Réduire la taille de l'élément de menu */
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        main {
            padding: 2em;
            max-width: 600px; /* Réduire la largeur du formulaire principal */
            margin: auto;
        }
        .service {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1.5em;
            margin-bottom: 1.5em;
            box-shadow: 0 4px 4px rgba(0,0,0,0.1);
            margin-top: -40px;
        }
        .service h2 {
            margin-top: 0;
            font-size: 1.2em; /* Réduire la taille de l'en-tête */
        }
        .service form {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Espacement réduit entre les éléments */

        }
        .service label, .service input, .service select, .service button {
            margin-bottom: 0.5em; /* Réduire l'espace en dessous des éléments */
        }
        .service input, .service select, .service button {
            padding: 8px; /* Réduire le padding dans les champs de saisie */
            font-size: 0.9em; /* Réduire la taille du texte dans les champs */
        }
        .service button {
            font-size: 1em;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .service button:hover {
            background-color: #45a049;
        }
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .button-container {
            display: flex;
            gap: 10px; /* Réduire l'écart entre les boutons */
            justify-content: flex-start;
        }
    </style>

</head>
<body>

<nav>
    <a href="?service=produits_commandes">Liste des Produits Commandés</a>
    <a href="?service=commandes">Liste des Commandes</a>
    <a href="?service=produits">Liste de tous les Produits</a>
</nav>
<header>
    <h1>Choix des Webservices</h1>
</header>
<main>
    <?php
    if (isset($_GET['service'])) {
        $service = $_GET['service'];
        switch ($service) {
            case 'produits_commandes':
                echo '
                    <section class="service">
                        <h2>Liste des Produits Commandés</h2>
                        <form action="http://localhost/WebService/REST.php" method="GET" target="_blank">
                            <input type="hidden" name="action" value="produits_commandes">
                            <label for="commande_id">Commande ID :</label>
                            <input type="number" id="commande_id" name="commande_id">
                            <label for="produit_id">Produit ID :</label>
                            <input type="number" id="produit_id" name="produit_id">
                            <label for="produit_designation">Désignation Produit :</label>
                            <input type="text" id="produit_designation" name="produit_designation">
                            <label for="commande_numero">Numéro Commande :</label>
                            <input type="text" id="commande_numero" name="commande_numero">
                            <button type="submit">Rechercher</button>
                        </form>
                    </section>';
                break;
            case 'commandes':
                echo '
                    <section class="service">
                        <h2>Liste des Commandes</h2>
                        <form action="http://localhost/WebService/REST.php" method="GET" target="_blank">
                            <input type="hidden" name="action" value="commandes">
                            <label for="numero">Numéro :</label>
                            <input type="text" id="numero" name="numero">
                            <label for="date_start">Date Début :</label>
                            <input type="date" id="date_start" name="date_start">
                            <label for="date_end">Date Fin :</label>
                            <input type="date" id="date_end" name="date_end">
                            <button type="submit">Rechercher</button>
                        </form>
                    </section>';
                break;
            case 'produits':
                echo '
                    <section class="service">
                        <h2>Liste de tous les Produits</h2>
                        <form action="http://localhost/WebService/REST.php" method="GET" target="_blank">
                            <input type="hidden" name="action" value="produits">
                            <label for="designation">Désignation :</label>
                            <input type="text" id="designation" name="designation">
                            <label for="prix_min">Prix Minimum :</label>
                            <input type="number" step="0.01" id="prix_min" name="prix_min">
                            <label for="prix_max">Prix Maximum :</label>
                            <input type="number" step="0.01" id="prix_max" name="prix_max">
                            <button type="submit">Rechercher</button>
                        </form>
                    </section>';
                break;

        }
    }
    ?>
</main>
<footer>
    <p>&copy; 2025 Choix des Webservices. Tous droits réservés a DIENE SARR.</p>
</footer>
</body>
</html>