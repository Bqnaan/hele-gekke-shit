<?php include "../navbar.html" ?>
<?php
    include_once '../connectionDatabase.php';
    include_once '../customer/functions.php';
    include_once '../reservation/functions.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!
    // reservering toevoegen

        if (isset($_POST['name']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['people'])) {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $people = $_POST['people'];

            // check of ze leeg zijn:
            if (empty($name) or empty($date) or empty($time) or empty($people)) {
                $warning = "Alle velden zijn verplicht<br>";
            } else {
                $id = createReservation($pdo, $name, $date, $time, $people);
                if (is_numeric($id)) {
                    $success = "Reservering met succes toegevoegd!<br>";
                } else {
                    $error = "Daar ging wat fout: " . $id . "<br>";
                }
            }
        }
    }

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = deleteReservation($pdo, $id);
    if (is_numeric($del)) {
        $success = "Reservering met succes verwijderd";
    } else {
        $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
    }

}

    // klanten ophalen:
    $customerList = customerList($pdo);


    // reserveringen ophalen:
    $reservationList = reservationList($pdo);
    ?>

<div class="container-fluid">
    <?php
    if (isset($warning)) {
        ?>
        <div class="alert alert-warning" role="alert">
            <?= $warning ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($success)) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
        <?php
    }
    ?>

    <?php
    if(isset($error)) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
        <?php
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

</head>
<body>

<form method="post" action="index.php">
    Klant (<a href="../customer/index.php" target="_blank">nieuw</a>):<br>
    <select name="name">
        <?php
        // klanten laten zien:
        foreach ($customerList as $c) {
            ?>
            <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php
        }
        ?>
    </select><br>
    Datum / tijd:<br>
    <input type="date" name="date"> - <input type="time" name="time"><br>
    Aantal personen:<br>
    <input type="text" name="people"><br>
    <input type="submit" value="Reserveren!">
</form>
<table border="1" class="table table-striped table-dark table-hover">
    <thead class="thead-dark">
    <tr>
        <th>id</th>
        <th>datum</th>
        <th>naam</th>
        <th>aantal personen</th>
        <th>telefoon</th>
        <th>actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($reservationList as $r) {
        ?>
        <tr>
            <th><?= $r['id'] ?></th>
            <td><?= $r['date'] ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['people'] ?></td>
            <td><?= $r['phone'] ?></td>
            <td><a class="btn btn-danger btn-sm" href="../reservation/index.php?delete=<?= $r['id'] ?>">delete</a>
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