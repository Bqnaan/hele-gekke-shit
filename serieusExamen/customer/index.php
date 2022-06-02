<?php
//customer / index.php
include_once '../connectionDatabase.php';
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        //alle velden bestaan en zijn ingevuld?
        //check of ze wel waarden hebben:
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        //check of ze leeg zijn
        if (empty($name) or empty($email) or empty($phone)) {
            $warning = "alle velden zijn wel verplicht jij hond<br>";
        } else {
            $id = createCustomer($pdo, $name, $email, $phone);
            //            echo $id;
            if (is_numeric($id)) {
                $success = "Klant met succes toegevoegd!<br>";
            } else {
                $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = deleteCustomer($pdo, $id);
    if (is_numeric($del)) {
        $success = "Klant met succes verwijderd";
    } else {
        $error = "Daar ging iets fout, probeer het opnieuw: " . $id . "<br>";
    }

}


$customers = customerList($pdo);

//dumpt variabele
//var_dump($customers);
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
            <!--            <form method="post" action="index.php">-->
            <!--                Name: <input type="text" name="name"><br>-->
            <!--                Email <input type="text" name="email"><br>-->
            <!--                Phone <input type="text" name="phone"><br>-->
            <!--                <input type="submit" value="New!">-->
            <!--            </form>-->

            <form method="post" action="index.php">
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone:</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" id="inputPhone">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add customer</button>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($customers as $c) {


                    ?>

                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['name'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td><?= $c['phone'] ?></td>
                        <td><a class="btn btn-danger" href="index.php?delete=<?= $c['id'] ?>">delete</a> |
                            <a class="btn btn-info" href="edit.php?id=<?= $c['id'] ?>">edit</a></td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
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
