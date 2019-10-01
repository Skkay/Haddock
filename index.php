<?php
    include("assets/chromephp-master/ChromePhp.php");
    include("administration/connect_bdd.php");
?>


<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

    <?php include("include/navbar.php"); ?>

    <p><br></p>

    <div class="container">
        <div class="jumbotron">
            <h5>Clique sur un album pour voir ces jurons ! <a href="tous-les-jurons.php">Ou clique ici pour avoir la liste de tous les jurons du Capitaine Haddock.</a></h5>
            <div class="card-columns">
                <?php
                    $bdd_albums = $bdd->query("
                        SELECT album.album_image, album.album_titre
                        FROM album
                        ORDER BY album.album_tome
                    ");

                    while($row = $bdd_albums->fetch()) {
                        echo '<div class="card">';
                        echo '<a href="les-jurons.php?album='.$row["album_image"].'"><img src="assets/ressources/albums/'.$row["album_image"].'.jpg" width="245px" height="342px" class="card-img-top" alt="'.$row["album_titre"].'"></a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>