<?php
function reservationList($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT reservation.id, reservation.people, reservation.date, customer.name, customer.email, customer.phone FROM reservation INNER JOIN customer ON reservation.customer_id=customer.id ORDER BY reservation.date ASC ");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return $e;
    }
}

function createReservation($pdo, $name, $date, $time, $people) {
    $time_stamp = $date . " " . $time;
    try {
        $stmt = $pdo->prepare("INSERT INTO reservation (customer_id, people, date) VALUES (?, ?, ?)");
        $stmt->execute([$name, $people, $time_stamp]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        return $e;
    }
}

function deleteReservation($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM reservation WHERE id = ?");
        $stmt->execute([$id]);
        return $id;
    } catch (PDOException $e) {
        return $e;
    }
}
