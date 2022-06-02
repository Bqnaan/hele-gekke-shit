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