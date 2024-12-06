<?php
include "pdo.php";

$error = null;

if (empty($_POST["email"])) {
    $error .= "Le mail ne peut pas etre vide <br>";
} elseif (!preg_match(" /^[^\W][a-zA-Z0-9]+(.[a-zA-Z0-9]+)@[a-zA-Z0-9]+(.[a-zA-Z0-9]+).[a-zA-Z]{2,4}$/ ", $_POST["email"])) {
    $error .= "Le mail n'est pas valide <br>";
} else {
    echo $_POST["email"] . "<br>";
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
            <label for="exampleInputEmail1" class="form-label mt-4">Email* :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="<?php echo @$_POST["email"] ?>">
        </div>
        <div>
            <label for="exampleInputPassword1" class="form-label mt-4">Password* :</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="envoyer">Se connecter</button>
    </form>

    <div id="connexion" style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-bottom: 2rem;">
        <p>Pas encore inscrit ?</p>
        <a href="inscription.php" class="btn btn-primary">Inscris-toi</a>
    </div>




    <?php
    if (!empty($error)) {
        echo '<div style="background-color: #ff0000; border: 2px solid yellow; border-radius: 10px; padding: 1rem; margin: auto; margin-top: 4rem; width: fit-content;">';
        echo $error;
        echo '</div>';
    }
    ?>

    <?php
    $motdepasse = @$_POST["password"];


    if (isset($_POST["envoyer"])) {
        
        if (empty($error)) {
            
            $sql = "SELECT * FROM abonne WHERE email = :email";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'email' => $_POST["email"]
            ]);
            $abonne = $statement->fetch(PDO::FETCH_ASSOC);
            if ($abonne) {
                if (password_verify($motdepasse, $abonne["password"])) {
                    echo "passwordVerify";
    ?>

                    <a href="inscription.php?flag=true" class="btn btn-primary">Deconnexion</a>

    <?php
                } else {
                    echo "non";
                }
            }
        }
    }


    ?>
    <?php include "footer.php"; ?>
</body>

</html>