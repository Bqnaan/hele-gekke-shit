<?php
function drinkTypeList($pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM `gerechtsoorten` WHERE gerechtcategorie_id = 4");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return $e;
    }
}

//Haal een lijst met dranksoorten op
function dranken($pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT id, naam FROM gerechtsoorten where gerechtcategorie_id = 4");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e;
    }
}

function beschrijvingen($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("SELECT id, code, beschrijving FROM menuitems WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e;
    }
}

function drinkName($pdo, $cat)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM `menuitems` WHERE gerechtsoort_id = ?");
        $stmt->execute([$cat]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return $e;
    }
}

function createDrink($pdo, $naam, $code, $beschrijving)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO menuitems (gerechtsoort_id, code, beschrijving) VALUES (?, ?, ?)");
        $stmt->execute([$naam, $code, $beschrijving]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        return $e;
    }
}

function addDrinkType($pdo, $code, $naam, $gerechtcategorie_id) {
    try {
        $stmt = $pdo->prepare("INSERT INTO `gerechtsoorten`(`code`, `naam`, `gerechtcategorie_id`) VALUES (?, ?, ?)");
        $stmt->execute([$code, $naam, $gerechtcategorie_id]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        return $e;
    }
}

function deleteDrinkType($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM gerechtsoorten WHERE id = ?");
        $stmt->execute([$id]);
        return $id;
    } catch (PDOException $e) {
        return $e;
    }
}

function updateDrink($pdo, $id, $naam, $code, $beschrijving)
{
    try {
        $stmt = $pdo->prepare("UPDATE menuitems SET code = ?, beschrijving = ? WHERE id = ?");

        $stmt->execute([$code, $beschrijving, $id]);
        return $id;
    } catch (PDOException $e) {
        return $e;
    }
}

function deleteDrink($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM menuitems WHERE id = ?");
        $stmt->execute([$id]);
        return $id;
    } catch (PDOException $e) {
        return $e;
    }
}
