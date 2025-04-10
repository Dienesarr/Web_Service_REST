<?php
class Commande {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterCommande($date,$numero,$total_commande) {
        $stmt = $this->pdo->prepare("INSERT INTO commandes (date,numero,total_commande) VALUES (:date ,:numero,:total_commande)");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
        $stmt->bindParam(':total_commande', $total_commande, PDO::PARAM_STR);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function obtenirCommandes() {
        $stmt = $this->pdo->query("SELECT * FROM commandes ORDER BY date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenirCommandeParId($commande_id) {
        $sql = "SELECT c.id AS commande_id, c.date, cp.produit_id, cp.quantite
                FROM commandes c
                LEFT JOIN commande_produit cp ON c.id = cp.commande_id
                WHERE c.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $commande_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function modifierCommande($commande_id, $date) {
        $stmt = $this->pdo->prepare("UPDATE commandes SET date = :date WHERE id = :id");
        $stmt->execute(['date' => $date, 'id' => $commande_id]);
    }
}
?>
