<?php

include_once '../connectionDatabase.php';
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!

    if (isset($_GET['id']) && isset($_POST['naam']) && isset($_POST['code']) && isset($_POST['beschrijving'])) {
        //alle velden bestaan en zijn ingevuld?
        //check of ze wel waarden hebben:
        $id = $_GET['id'];
        $naam = $_POST['naam'];
        $code = $_POST['code'];
        $beschrijving = $_POST['beschrijving'];
//        $id = $_POST['id'];

        //check of ze leeg zijn
        if (empty($naam) or empty($code) or empty($beschrijving)) {
            $warning = "alle velden zijn wel verplicht<br>";
        } else {
            $updateDrink = updateDrink($pdo, $id, $naam, $code, $beschrijving);
                        echo $updateDrink;
            if (is_numeric($updateDrink)) {
                $success = "Drinken met succes toegevoegd!<br>";
            } else {
                $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
            }
        }
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dranken = dranken($pdo);
    $beschrijvingen = beschrijvingen($pdo, $id);

//    var_dump($c);
}
//$dranken = dranken($pdo);

?>

<form method="post" action="editDrinks.php?id=<?= $id ?>">
    <select required class="uk-select" id="naam" name="naam">
        <option disabled> Kies een dranksoort</option>
        <?php
        foreach ($dranken as $d) {
            echo '<option selected value="' . $d['id'] . '">' . $d['naam'] . '</option>';
        }
        ?>
    </select> <br>
    Code:
    <?php
    foreach ($beschrijvingen as $b) {
        ?>
        <input required type="text" id="code" maxlength="3" minlength="3" name="code" value="<?= $b['code']?>"><br>
    <?php
    }
    ?>
    Beschrijving:
    <?php
    foreach ($beschrijvingen as $b) {

        ?>
        <input required type="text" id="beschrijving" name="beschrijving" value="<?= $b['beschrijving']?>"><br>
        <?php
    }
    ?>
    <input type="submit" value="Save">
</form>