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
    include "header.php";
    require "pdo.php";

    $erreur = null;

    @$auteur = strip_tags($_POST["auteur"]);
    @$titre = strip_tags($_POST["titre"]);

    $statement = $pdo->prepare("SELECT * from livre where id_livre = :id");
    $statement->execute([
        "id" => $_GET['id_livre']
    ]);

    $livre = $statement->fetch();
    //var_dump($livre);


    if (isset($_POST["valider"])) {

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
            $sql = "UPDATE livre SET auteur = :auteur, titre = :titre WHERE id_livre = :id";

            $statement = $pdo->prepare($sql);
            $statement->execute([
                "auteur" => $_POST["auteur"],
                "titre" => $_POST["titre"],
                "id" => $_GET['id_livre']
            ]);
            header("location: livres.php");
        }
    }
    ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">id_livre</th>
                <th scope="col">auteur</th>
                <th scope="col">titre</th>
            </tr>
        </thead>
        <tbody>


            <tr class="table-active">
                <td><?= $livre['id_livre'] ?></td>
                <td><?= $livre['auteur'] ?></td>
                <td><?= $livre['titre'] ?></td>
            </tr>


        </tbody>
    </table>

    <form action="" method="post">
        <div>
            <label class="form-label mt-4">Auteur :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="auteur" aria-describedby="emailHelp" placeholder="Enter auteur" value="<?= $livre["auteur"] ?>">
        </div>
        <div>
            <label class="form-label mt-4">Titre :</label>
            <input type="text" class="form-control" placeholder="Enter titre" name="titre" value="<?= $livre["titre"]  ?>">
        </div>
        <button type="submit" name="valider" class="btn btn-primary">Valider</button>
    </form>

</body>

</html>