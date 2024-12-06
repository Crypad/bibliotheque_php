<?php

function valideDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    if ($d && $d->format($format) == $date) {
        return true;
    } else {
        return false;
    }
}

$error = null;

if (isset($_POST["envoyer"])) {
    if (empty($_POST["nom"])) {
        $error = "Le nom ne peut pas etre vide <br>";
    } elseif ((strlen($_POST["nom"]) < 2) || (strlen($_POST["nom"]) > 50)) {
        $error .= "Le nom doit contenir entre 2 et 50 caracteres <br>";
    } else {
        echo $_POST["nom"] . "<br>";
    }
}

if (isset($_POST["envoyer"])) {
    if (empty($_POST["prenom"])) {
        $error = "Le prenom ne peut pas etre vide <br>";
    } elseif ((strlen($_POST["prenom"]) < 2) || (strlen($_POST["prenom"]) > 50)) {
        $error .= "Le prenom doit contenir entre 2 et 50 caracteres <br>";
    } else {
        echo $_POST["prenom"] . "<br>";;
    }
}

if (empty($_POST["email"])) {
    $error .= "Le mail ne peut pas etre vide <br>";
} elseif (!preg_match(" /^[^\W][a-zA-Z0-9]+(.[a-zA-Z0-9]+)@[a-zA-Z0-9]+(.[a-zA-Z0-9]+).[a-zA-Z]{2,4}$/ ", $_POST["email"])) {
    $error .= "Le mail n'est pas valide <br>";
} else {
    echo $_POST["email"] . "<br>";
}

if (empty($_POST["password"])) {
    $error .= "Le password ne peut pas etre vide <br>";
} elseif ((strlen($_POST["password"]) < 8) || (strlen($_POST["password"]) > 50)) {
    $error .= "Le password doit contenir entre 8 et 50 caracteres <br>";
} /* else {
    echo $_POST["password"] . "<br>";
} */

if (empty($_POST["date"])) {
    $error .= "La date ne peut pas etre vide <br>";
} elseif (!valideDate($_POST["date"])) {
    $error .= "La date n'est pas valide <br>";
} else {
    echo $_POST["date"] . "<br>";
}

if (!empty($_POST["phone"])) {
    if (!preg_match('#^0[1-9]{1}\d{8}$#', $_POST["phone"])) {
        $error .= "Le numéro de téléphone n'est pas valide <br>";
    } else {
        echo $_POST["phone"] . "<br>";
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/style.css">
    <script src="./assets/script.js" defer></script>
    <title>Document</title>
</head>

<body>

    <?php include "header.php"; ?>

    <form action="" method="post" id="formulaire">
        <div>
            <label for="exampleInputEmail1" class="form-label mt-4">Nom* :</label>
            <input type="text" class="form-control" placeholder="Enter Name" name="nom" value="<?php echo @$_POST["nom"] ?>">
        </div>
        <div>
            <label for="exampleInputEmail1" class="form-label mt-4">Prénom* :</label>
            <input type="text" class="form-control" placeholder="Enter Surname" name="prenom" value="<?php echo @$_POST["prenom"] ?>">
        </div>
        <div>
            <label for="exampleInputEmail1" class="form-label mt-4">Email* :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="<?php echo @$_POST["email"] ?>">
        </div>
        <div>
            <label for="exampleInputPassword1" class="form-label mt-4">Password* :</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" name="password">
        </div>
        <div>
            <label for="exampleInputPassword1" class="form-label mt-4">Date* :</label>
            <input type="date" class="form-control" id="exampleInputPassword1" name="date" value="<?php echo @$_POST["date"] ?>">
        </div>
        <div>
            <label for="exampleInputPassword1" class="form-label mt-4">Telephone :</label>
            <input type="phone" class="form-control" id="exampleInputPassword1" name="phone" value="<?php echo @$_POST["phone"] ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="envoyer">S'inscrire</button>
    </form>

    <div id="connexion" style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-bottom: 2rem;">
        <p>Déja inscrit ?</p>
        <a href="connexion.php" class="btn btn-primary">Connecte toi</a>
    </div>

    <?php
    include "pdo.php";
    ?>

    <?php

    $motdepasse = @$_POST["password"];

    $hash = password_hash($motdepasse, PASSWORD_DEFAULT);
    echo $hash;

    try {
        $sql = "INSERT INTO abonne (prenom, nom, email, password) VALUES (:prenom, :nom, :email, :password)";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'prenom' => $_POST["prenom"],
            'nom' => $_POST["nom"],
            'email' => $_POST["email"],
            'password' => $hash         
        ]);
    } catch (PDOException $error) {
        echo $error->getMessage();
    }


    ?>

    <?php
    if (!empty($error)) {
        echo '<div style="background-color: #ff0000; border: 2px solid yellow; border-radius: 10px; padding: 1rem; margin: auto; margin-top: 4rem; width: fit-content;">';
        echo $error;
        echo '</div>';
    }
    ?>
    <?php include "footer.php"; ?>
</body>

</html>