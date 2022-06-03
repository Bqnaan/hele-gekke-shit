<?php
function orderList($pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM bestellingen");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return $e;
    }
}

function menuitemsList($pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM menuitems");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return $e;
    }
}

function getItems($pdo)
{
    {
        try {
            $stmt = $pdo->prepare(" SELECT reservation.tafel, bestellingen.aantal, menuitems.beschrijving 
                                    FROM bestellingen INNER JOIN menuitems on bestellingen.menuitem_id = menuitems.id 
                                    INNER JOIN reservation on bestellingen.reservering_id = reservation.id 
                                    WHERE menuitems.gerechtsoort_id IN (2,4,5,6,7) ORDER BY bestellingen.id ASC");
//
            $stmt->execute([]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
}