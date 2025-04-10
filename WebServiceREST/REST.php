<?php
include 'model/db.php';
include 'model/Produits.php';
include 'model/Commande.php';
include 'model/CommandeProduits.php';

$database = new Database();
$db = $database->getConnection();

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'produits_commandes':
        $commandeProduit = new CommandeProduit($db);
        $commande_id = isset($_GET['commande_id']) ? $_GET['commande_id'] : null;
        $produit_id = isset($_GET['produit_id']) ? $_GET['produit_id'] : null;
        $produit_designation = isset($_GET['produit_designation']) ? $_GET['produit_designation'] : null;
        $commande_numero = isset($_GET['commande_numero']) ? $_GET['commande_numero'] : null;
        $result = $commandeProduit->getAll($commande_id, $produit_id, $produit_designation, $commande_numero);
        break;


    case 'commandes':
        $commande = new Commande($db);
        $numero = isset($_GET['numero']) ? $_GET['numero'] : null;
        $date_start = isset($_GET['date_start']) ? $_GET['date_start'] : null;
        $date_end = isset($_GET['date_end']) ? $_GET['date_end'] : null;
        $result = $commande->getAll($numero, $date_start, $date_end);
        break;

    case 'produits':
        $produit = new Produit($db);
        $designation = isset($_GET['designation']) ? $_GET['designation'] : null;
        $prix_min = isset($_GET['prix_min']) ? $_GET['prix_min'] : null;
        $prix_max = isset($_GET['prix_max']) ? $_GET['prix_max'] : null;
        $result = $produit->getAll($designation, $prix_min, $prix_max);
        break;

    default:
        $result = ['error' => 'Action non définie'];
        break;
}

header('Content-Type: application/json');
echo json_encode($result);
