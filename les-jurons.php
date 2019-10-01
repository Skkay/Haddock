<?php
    include("assets/chromephp-master/ChromePhp.php");
    include("administration/connect_bdd.php");

    if (!isset($_GET["album"])) {
        header('Location: /Haddock');
        exit();
    }
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
            <div class="media">
                <?php
                $album = $_GET["album"];
                echo '<img src="assets/ressources/albums/'.$album.'.jpg" width="157px" height="212px" class="align-self-start mr-3" alt="'.$album.'">';
                echo '<div class="media-body">';

                // Obtention du titre de l'album
                $bdd_titre = $bdd->query("
                    SELECT album.album_titre, album.album_tome, album.album_parution FROM album WHERE album.album_image LIKE '".$album."'
                ");
                $row = $bdd_titre->fetch();
                $titre = $row["album_titre"];
                $tome = $row["album_tome"];
                $parution = $row["album_parution"];
                //ChromePhp::log($tome);

                // Obtention du nombre de jurons de l'album
                $bdd_nb_jurons = $bdd->query("
                    SELECT COUNT(jurons.jurons_texte) AS nb_jurons 
                    FROM jurons, se_trouver_bulle, album 
                    WHERE jurons.jurons_num = se_trouver_bulle.jurons_num 
                    AND se_trouver_bulle.ref_album LIKE album.album_ref 
                    AND album.album_image LIKE '".$album."'
                ");
                $row = $bdd_nb_jurons->fetch();
                $nb_jurons = $row["nb_jurons"];
                //ChromePhp::log($nb_jurons);

                echo '<h5 class="mt-0">'.$titre.'</h5>';
                if ($nb_jurons == 0) {
                    echo 'C\'est l\'album n°'.$tome.' paru en '.$parution.'. Il ne contient aucun juron.';
                }
                else if ($nb_jurons == 1) {
                    echo 'C\'est l\'album n°'.$tome.' paru en '.$parution.'. Il contient '.$nb_jurons.' juron :';
                }
                else {
                    echo 'C\'est l\'album n°'.$tome.' paru en '.$parution.'. Il contient ces '.$nb_jurons.' jurons :';
                }

                // Obtention des jurons de l'album
                $bdd_jurons = $bdd->query("
                    SELECT jurons.jurons_texte, se_trouver_bulle.num_page
                    FROM jurons, se_trouver_bulle, album 
                    WHERE jurons.jurons_num = se_trouver_bulle.jurons_num 
                    AND se_trouver_bulle.ref_album LIKE album.album_ref 
                    AND album.album_image LIKE '".$album."'
                ");
                echo '<ul>';
                $pre_jurons = "";
                while($row = $bdd_jurons->fetch()) {
                    //ChromePhp::log($row["jurons_texte"] . " - " . $row["num_page"]);
                    echo '<li><b>'.$row["jurons_texte"].'</b> à la page '.$row["num_page"].'</li>';
                }
                echo '</ul>';
                ?>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>