<?php
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");
    
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }

    $result = $bdd->query("
        SELECT COUNT(jurons_texte) 
        AS total 
        FROM jurons
    ");
    $row_jurons = $result->fetch();
    $nb_jurons = $row_jurons["total"];

    $result = $bdd->query("
        SELECT COUNT(album_titre) 
        AS total 
        FROM album
    ");
    $row_album = $result->fetch();
    $nb_album = $row_album["total"];

?>


<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

    <?php include("../include/navbar.php"); ?>

    <p><br></p>
    
    <div class="container">
        <div class="jumbotron">
            <h1>Administration</h1>
            <hr class="my-4">
            <div class="alert alert-primary" role="alert">
                <b><?php echo $nb_jurons ?></b> jurons et <b><?php echo $nb_album ?></b> albums.
            </div>
            <hr class="my-4"> 
            <ul>
                <li><a href="jurons.php">Liste des albums et jurons</a></li>
                <li><a href="ajouter.php">Ajouter un juron à une case existante</a></li>
                <li><a href="ajouter_album.php">Ajouter un nouvel album</a></li>
                <li><a href="ajouter_page.php">Ajouter une nouvelle page à un album existant</a></li>
                <li><a href="ajouter_bande.php">Ajouter une nouvelle bande à une page existante</a></li>
                <li><a href="ajouter_case.php">Ajouter une nouvelle case à une bande existante</a></li>
                <li><a href="ajouter_juron.php">Ajouter un nouveau juron</a></li>
            </ul>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>