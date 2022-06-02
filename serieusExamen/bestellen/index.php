<?php include "../navbar.html" ?>
<?php
include_once '../connectionDatabase.php';
include_once '../customer/functions.php';
include_once '../bestellen/functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!
    // reservering toevoegen

    if (isset($_POST['tafel']) && isset($_POST['gerechtscategorie_id']) && isset($_POST['naam'])) {
        $tafel = $_POST['tafel'];
        $categorie = $_POST['gerechtscategorie_id'];
        $time = $_POST['naam'];

        // check of ze leeg zijn:
        if (empty($tafel) or empty($gerechtcategorie_id) or empty($naam)) {
            $warning = "Alle velden zijn verplicht<br>";
        } else {
            $id = createOrder($pdo, $tafel, $gerechtcategorie_id, $naam);
            if (is_numeric($id)) {
                $success = "Bestelling met succes geplaatst!<br>";
            } else {
                $error = "Daar ging wat fout: " . $id . "<br>";
            }
        }
    }
}
//info ophalen
$orderInfo = orderInfo($pdo);

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
        Tafel:<br>
        <select name="tafel">
            <?php
            // tafels laten zien:
            foreach ($orderInfo as $o) {
                ?>
                <option value="<?= $o['tafel'] ?>"></option>
                <?php
            }
            ?>
        </select><br>
        Gerechtcategorie:<br>
        <select name="tafel">
        <?php
        // tafels laten zien:
        foreach ($orderInfo as $o) {
            ?>
            <option value="<?= $o['gerechtscategorie_id'] ?>"></option>
            <?php
        }
        ?>
        </select>
        Aantal personen:<br>
        <input type="text" name="people"><br>
        <input type="submit" value="Reserveren!">
    </form>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
    </body>
