<?php
//customer / edit.php

include_once '../connectionDatabase.php';
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
// iemand heeft dit gepost!

    if (isset($_POST['id']) && isset($_POST['naam']) && isset($_POST['beschrijving'])) {
//alle velden bestaan en zijn ingevuld?
//check of ze wel waarden hebben:
        $id = $_POST['id'];
        $naam = $_POST['naam'];
        $beschrijving = $_POST['beschrijving'];

//check of ze leeg zijn
        if (empty($naam) or empty($beschrijving)) {
            echo "alle velden zijn wel verplicht jij hond<br>";
        } else {
            $update = updateDrink($pdo, $id, $naam, $beschrijving);
//                        echo $id;
            if (is_numeric($update)) {
                echo "Klant met succes aangepast! Klik <a href='index.php'>hier om terug te gaan naar het overzicht</a><br>";
            } else {
                echo "Daar ging iets fout, probeer het opnieuw: " . $update . "<br>";
            }
        }
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $drinkTypeList = drinkTypeList($pdo);

    $drinkCategoryList = drinkCategoryList($pdo);

    $drinkName = drinkName($pdo, $cat);

    $updateDrink = updateDrink($pdo, $id, $naam, $beschrijving);
//    var_dump($c);
}

?>

<form method="post" action="edit.php?id=<?= $id ?>">
    <select name="name">
        <?php
        foreach ($drinkCategoryList as $c) {

            ?>
            <option value="<?= $t['id'] ?>"><?= $t['naam'] ?></option>
            <?php
        }
        ?>
    </select><br>
    <input type="submit" value="Save">
</form>
