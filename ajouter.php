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

    <?php
    require "pdo.php";

    // var_dump($_POST);

    $erreur = null;
    @$auteur = strip_tags($_POST["auteur"]);
    @$titre = strip_tags($_POST["titre"]);

    if (isset($_POST["ajouter"])) {

        if (empty($auteur)) {
            $erreur .= "Le nom de l'auteur ne peut pas etre vide <br>";
        } elseif (strlen($auteur) < 2 || strlen($auteur) > 50) {
            $erreur .= "Veuillez entrer un nom valide <br>";
        }

        if (empty($titre)) {
            $erreur .= "Le titre ne peut pas etre vide <br>";
        } elseif (strlen($titre) < 2 || strlen($titre) > 50) {
            $erreur .= "Veuillez entrer un titre valide <br>";
        }

    
        if (empty($erreur)) {
            try {
                $statement = $pdo->prepare("INSERT INTO livre (auteur, titre) 
                                            VALUES (:auteur, :titre)");
                $statement->execute([
                    "auteur" => $auteur,
                    "titre" => $titre,
                ]);

                header(
                    "location: livres.php"
                );
    
    
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }





    ?>

    <form action="" method="post">
        <div>
            <label class="form-label mt-4">Auteur :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="auteur" aria-describedby="emailHelp" placeholder="Auteur">
        </div>
        <div>
            <label class="form-label mt-4">Titre :</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Titre" name="titre">
        </div>

        <button type="submit" name="ajouter" class="btn btn-primary">Ajouter un livre</button>
    </form>



    <?php include "footer.php"; ?>

    <?php
    if (!empty($erreur)) {
        echo '<div style="background-color: #ff0000; border: 2px solid yellow; border-radius: 10px; padding: 1rem; margin: auto; margin-top: 4rem; width: fit-content;">';
        echo $erreur;
        echo '</div>';
    }
    ?>

</body>

</html>