<?php

require "pdo.php";

var_dump($_GET);

try {
    $sql = "DELETE FROM livre WHERE id_livre = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $_GET["id_livre"]
    ]);

    header("location: livres.php");
    exit;

} catch (PDOException $error) {
    echo $error->getMessage();
}

?>