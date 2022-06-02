<?php
include_once '../connectionDatabase.php';
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!
//var_dump($_POST);
    if (isset($_POST['code']) && isset($_POST['naam'])) {
        //alle velden bestaan en zijn ingevuld?
        //check of ze wel waarden hebben:
        $code = $_POST['code'];
        $naam = $_POST['naam'];
        $gerechtcategorie_id = $_POST['gerechtcategorie_id'];

        //check of ze leeg zijn
        if (empty($code) or empty($naam) or empty($gerechtcategorie_id)) {
            $warning = "alle velden zijn wel verplicht<br>";
        } else {
            $id = addDrinkType($pdo, $code, $naam, $gerechtcategorie_id);
//                        echo $id;
            if (is_numeric($id)) {
                $success = "Drinksoort met succes toegevoegd! <a href='index.php'>Klik hier om terug te gaan naar het drank menu</a> <br>";
            } else {
                $error = "Daar ging iets fout, probeer het opnieuw<br>";
            }
        }
        $addDrinkType = addDrinkType($pdo, $code, $naam, $gerechtcategorie_id);
    }
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = deleteDrinkType($pdo, $id);
    if (is_numeric($del)) {
        $success = "Drank soort met succes verwijderd";
    } else {
        $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
    }

}

$drinkTypeList = drinkTypeList($pdo);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--  header  -->
    <?php include "../navbar.html"?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
        <div class="col-md-6">
            <form method="post" action="addDrinkType.php">
                <div class="row mb-3">
                    <label for="inputCode" class="col-sm-2 col-form-label">Code:</label>
                    <div class="col-sm-10">
                        <input maxlength="3" type="text" name="code" class="form-control" id="inputCode">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNaam" class="col-sm-2 col-form-label">Soort drinken:</label>
                    <div class="col-sm-10">
                        <input type="text" name="naam" class="form-control" id="inputNaam">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputCategorie" class="col-sm-2 col-form-label">ID (standaard op 4):</label>
                    <div class="col-sm-10">
                        <input type="text" name="gerechtcategorie_id" value="4" class="form-control" id="inputCategorie">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Voeg drink type toe</button>
            </form>
            <br>
            <div class="col-md-6">
                <table class="table table-striped table-dark table-hover">
                    <thead>
                    <tr>
                        <th>Categorie ID</th>
                        <th>Categorie code</th>
                        <th>Categorie</th>
                        <th>Bewerken</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($drinkTypeList as $d) {

                    ?>

                    <tr>
                        <td><?= $d['id'] ?></td>
                        <td><?= $d['code'] ?></td>
                        <td><?= $d['naam'] ?></td>
                        <td><a class="btn btn-danger" href="addDrinkType.php?delete=<?= $d['id'] ?>">delete</a>


                        <?php
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

