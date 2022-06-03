<?php include "../navbar.html" ?>
<?php
include_once '../connectionDatabase.php';
include_once '../customer/functions.php';
include_once '../reservation/functions.php';
include_once 'functions.php';

$getRekening = getRekening($pdo);
$getItems = getItems($pdo);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

</head>
<body>
<p>Totaal bon</p>
<table class="table table-striped table-dark table-hover">
    <thead>
    <tr>
<!--        helaas snel moeten hardcoden ivm tijdsnood :(      -->
        <th>Tafel: 8</th>
    </tr>
    <tr>
        <th>Gerecht</th>
        <th>Aantal</th>
        <th>Prijs</th>
        <th>Totaal</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($getRekening as $i) {
        ?>
        <tr>
            <td><?= $i['beschrijving'] ?></td>
            <td><?= $i['aantal'] ?></td>
            <td><?= $i['prijs'] ?></td>
            <td><?= $totaal = $i['prijs'] * $i['aantal']; $totaal  ?></td>
        </tr>
    <?php } ?>
    Totaal te betalen: WERKT NOG NIET
    </tbody>
</table>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>

