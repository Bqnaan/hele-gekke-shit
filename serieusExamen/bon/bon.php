<?php include "../navbar.html" ?>
<?php
include_once '../connectionDatabase.php';
include_once '../customer/functions.php';
include_once '../reservation/functions.php';
include_once 'functions.php';
$getItems = getItems($pdo);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

</head>
<body>
<p>Actueel overzicht van te maken gerechten</p>
<table class="table table-striped table-dark table-hover">
    <thead>
    <tr>
        <?php
        foreach ($getItems as $i){
            ?>
            <th>Tafel:<?= $i['tafel'] ?> </th>
            <?php
        }
        ?>
        <th>Tafel</th>
        <th>Aantal</th>
        <th>Gerechten</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($getItems as $i) {
        ?>
        <tr>
            <td><?= $i['tafel'] ?></td>
            <td><?= $i['aantal'] ?></td>
            <td><?= $i['beschrijving'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>

