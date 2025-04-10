<?php
class Produit {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterProduit($designation, $prix ,$description) {
        $stmt = $this->pdo->prepare("INSERT INTO produits (designation, prix,description) VALUES (:designation, :prix, :description)");
        $stmt->bindParam(':designation', $designation, PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function obtenirProduits() {
        $stmt = $this->pdo->query("SELECT * FROM produits ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
