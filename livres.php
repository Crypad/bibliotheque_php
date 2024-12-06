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

    try {
        $sql = "SELECT * FROM livre";
        $statement = $pdo->query($sql);
        $livres = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $error->getMEssage();
    }

    ?>
    <div style="width: 100%; display: flex; justify-content: center;">
        <a href="ajouter.php" class="btn btn-primary" style="width: 50%; margin: 1rem 0;">Ajouter un livre</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">id_livre</th>
                <th scope="col">Auteur</th>
                <th scope="col">Titre</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($livres as $livre) { ?>
                <tr class="table-active">
                    <td><?= $livre['id_livre'] ?></td>
                    <td><?= $livre['auteur'] ?></td>
                    <td><?= $livre['titre'] ?></td>

                    <td><a href="modifier.php?id_livre=<?= $livre['id_livre'] ?>">Modifier des informations</a></td>
                    <td><a href="supprimer.php?id_livre=<?= $livre['id_livre'] ?>">Supprimer</a></td>

                </tr>
            <?php } ?>

        </tbody>

</body>

</html>