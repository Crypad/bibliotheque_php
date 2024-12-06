<!-- <!DOCTYPE html>
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


$pdo = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

/* try {
    $statement = $pdo->query("SELECT * FROM livre");
    $livres = $statement->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
var_dump($livres); */
?>

 <table class="table table-hover">
    <thead>
        <tr>
    </thead>
    <tr class="table-primary">
        <
        // <th scope="row">Primary</th>
        for ($i=0; $i < sizeof($livres); $i++) { 
            echo "<tr>" . $livres[$i]["titre"] . "</tr>";
            
        }
        
    </tr>
</table>









</body>
</html> -->




