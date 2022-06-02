<?php
function orderInfo($pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM reservation, menuitems, gerechtcategorien, gerechtsoorten");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return $e;
    }
}