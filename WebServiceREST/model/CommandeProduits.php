<?php
class CommandeProduit {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ProduitCommande($commande_id, $produit_id, $prix, $quantite) {
        // Calcul du total (prix * quantite)
        $total = $prix * $quantite;

        // Préparation de la requête SQL
        $stmt = $this->pdo->prepare("INSERT INTO commande_produits (commande_id, produit_id, prix, quantite, total) 
                                 VALUES (:commande_id, :produit_id, :prix, :quantite, :total)");

        // Liaison des paramètres
        $stmt->bindParam(':commande_id', $commande_id, PDO::PARAM_INT);
        $stmt->bindParam(':produit_id', $produit_id, PDO::PARAM_INT);
        $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);  // Si prix est une chaîne ou un nombre à virgule flottante
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);  // Quantité devrait être un entier
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);  // Total devrait être une chaîne ou un nombre à virgule flottante

        // Exécution de la requête
        return $stmt->execute();
    }

    public function obtenirCommandesProduits() {
        $sql = "SELECT c.id AS commande_id, c.date, c.numero,p.designation ,cp.quantite ,cp.total
                FROM commandes c
                LEFT JOIN commande_produits cp ON c.id = cp.commande_id
                LEFT JOIN produits p ON p.id = cp.produit_id
                ORDER BY c.date DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


       /* $sql = "SELECT * FROM commandes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
       */
    }

    public function obtenirProduits() {
        $sql = "SELECT * FROM produits";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function supprimerCommande($commande_id) {
        try {
            // Supprimer tous les produits associés à la commande
            $stmt = $this->pdo->prepare("DELETE FROM commande_produit WHERE commande_id = :commande_id");
            $stmt->execute(['commande_id' => $commande_id]);
    
            // Ensuite, supprimer la commande elle-même
            $stmt = $this->pdo->prepare("DELETE FROM commandes WHERE id = :commande_id");
            $stmt->execute(['commande_id' => $commande_id]);
    
            if ($stmt->rowCount() > 0) {
                return "Commande supprimée avec succès.";
            } else {
                return "Aucune commande supprimée, vérifiez les données.";
            }
        } catch (Exception $e) {
            return "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
}
?>