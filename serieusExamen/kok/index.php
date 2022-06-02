<?php include "../navbar.html" ?>
<?php
include_once '../connectionDatabase.php';
include_once '../customer/functions.php';
include_once '../reservation/functions.php';
include_once '../kok/functions.php';

//if (isset($_GET['delete'])) {
//    $id = $_GET['delete'];
//
//    $del = deleteReservation($pdo, $id);
//    if (is_numeric($del)) {
//        $success = "Reservering met succes verwijderd";
//    } else {
//        $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
//    }
//
//}

// klanten ophalen:
$customerList = customerList($pdo);

// reserveringen ophalen:
$reservationList = reservationList($pdo);

// menu items ophalen
$menuitemsList = menuitemsList($pdo);
//
//
//// orderlist ophalen:
 $orderList = orderList($pdo);
?>

<!--<div class="container-fluid">-->
<!--    --><?php
//    if (isset($warning)) {
//        ?>
<!--        <div class="alert alert-warning" role="alert">-->
<!--            --><?//= $warning ?>
<!--        </div>-->
<!--        --><?php
//    }
//    ?>
<!---->
<!--    --><?php
//    if (isset($success)) {
//        ?>
<!--        <div class="alert alert-success" role="alert">-->
<!--            --><?//= $success ?>
<!--        </div>-->
<!--        --><?php
//    }
//    ?>
<!---->
<!--    --><?php
//    if(isset($error)) {
//        ?>
<!--        <div class="alert alert-danger" role="alert">-->
<!--            --><?//= $error ?>
<!--        </div>-->
<!--        --><?php
//    }
//    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

</head>
<body>
<table border="1" class="table table-striped table-dark table-hover">
    <thead class="thead-dark">
    <tr>
        <th>tafel</th>
        <th>aantal</th>
        <th>gerecht</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderList as $r) {
        ?>
        <tr>
            <th><?= $reservationList['tafel'] ?></th>
            <td><?= $reservationList['aantal'] ?></td>
            <td><?= $menuitemsList['naam'] ?></td>
<!--            <td><a class="btn btn-danger btn-sm" href="../reservation/index.php?delete=--><?//= $r['id'] ?><!--">delete</a>-->
        </tr>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
