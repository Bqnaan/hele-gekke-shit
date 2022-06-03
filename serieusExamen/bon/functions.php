<?php
function getItems($pdo)
{
    {
        try {
            $stmt = $pdo->prepare(" SELECT reservation.tafel, bestellingen.aantal, menuitems.beschrijving, menuitems.prijs 
                                    FROM bestellingen b INNER JOIN menuitems on b.menuitem_id, b.menuitem.prijs = menuitems.id 
                                    INNER JOIN reservation on bestellingen.reservering_id = reservation.id 
                                    WHERE bestellingen.reservering_id IN (8) ORDER BY bestellingen.id ASC");
            $stmt->execute([]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
}