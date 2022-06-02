<?php
include_once '../connectionDatabase.php';
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!

    if (isset($_POST['naam']) && isset($_POST['code']) && isset($_POST['beschrijving'])) {
        //alle velden bestaan en zijn ingevuld?
        //check of ze wel waarden hebben:
        $naam = $_POST['naam'];
        $code = $_POST['code'];
        $beschrijving = $_POST['beschrijving'];

        //check of ze leeg zijn
        if (empty($naam) or empty($code) or empty($beschrijving)) {
            $warning = "alle velden zijn wel verplicht<br>";
        } else {
            $id = createDrink($pdo, $naam, $code, $beschrijving);
            //            echo $id;
            if (is_numeric($id)) {
                $success = "Drinken met succes toegevoegd!<br>";
            } else {
                $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = deleteDrink($pdo, $id);
    if (is_numeric($del)) {
        $success = "Klant met succes verwijderd";
    } else {
        $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
    }

}

$drinkTypeList = drinkTypeList($pdo);

$dranken = dranken($pdo)

//dumpt variabele
//var_dump($drinkList);
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--  header  -->
    <?php include "../navbar.html"?>

    <title>Hello, world!</title>
</head>
<body>
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
    <div class="row">
        <a href="addDrinkType.php">Voeg hier een nieuwe drankjes categorie toe</a><br>
        <div class="col-md-6">
            <form method="post" action="index.php">
                <div class="row mb-3">
                    <label for="inputDrink" class="col-sm-2 col-form-label">Drank:</label>
                    <div class="col-sm-10">
                        <select required class="uk-select" id="naam" name="naam">
                            <option disabled selected> Kies een dranksoort</option>
                            <?php
                            foreach ($dranken as $d) {
                                echo '<option value="' . $d['id'] . '">' . $d['naam'] . '</option>';
                            }
                            ?>
                        </select>
                        <!--                        <input type="text" name="beschrijving" class="form-control" id="inputDrink">-->
                    </div>
                    <div class="row mb-3">
                        <label for="inputCode" class="col-sm-2 col-form-label">Code:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="3" minlength="3" name="code" class="form-control" id="code">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputBeschrijving" class="col-sm-2 col-form-label">Drankje:</label>
                    <div class="col-sm-10">
                        <input type="text" name="beschrijving" class="form-control" id="inputBeschrijving">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Voeg drinken toe</button>
            </form>
            <br>
            <div class="col-md-6">
                <table class="table table-striped table-dark table-hover">
                    <thead>
                    <tr>
                        <th>valt onder</th>
                        <th>code</th>
                        <th>Beschrijving</th>
                        <th>Bewerken</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($drinkTypeList as $d) {
                        $drinkName = drinkName($pdo, $d['id']);
                        foreach ($drinkName as $n) {

                        ?>

                        <tr>
                            <td><?= $d['naam'] ?></td>
                            <td><?= $d['code'] ?></td>
                            <td><?= $n['beschrijving'] ?></td>
                            <td><a class="btn btn-danger" href="index.php?delete=<?= $n['id'] ?>">delete</a>


                        <?php
                        }
                    }
                    ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>