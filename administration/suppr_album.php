<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");
    if (!isset($_GET["album"])) {
        //header('Location: /Haddock/administration');
        //exit();
    }
    else {
        $ref_album = $_GET["album"];
        $bdd_album = $bdd->query("
            SELECT *
            FROM album
            WHERE album_ref LIKE '$ref_album'
        ");
        $row = $bdd_album->fetch();
    }
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
            <?php
                if (!$row) {
                    ChromePhp::log("Élément non trouvé");
                    echo '<p><i>L\'élément sélectionné n\'existe pas...</i></p>';
                    echo '<p><a onclick="window.location.href = \'jurons.php\';" class="btn btn-primary" role="button" href="#">Retour</a></p>';
                }
                else {
                    echo '<h3 class="text-danger">Attention !</h3>';
                    echo '<p>Vous êtes sur le point de supprimer l\'élément suivant :</p>';

                    echo '<b>Album : </b>'.$row["album_titre"].' ('.$row["album_ref"].')';
                    echo '<br><b>Tome : </b>'.$row["album_tome"];
                    echo '<br><b>Parution : </b>'.$row["album_parution"];
                    echo '<br><b>Image : </b><a target="_blank" href="../assets/ressources/albums/'.$row["album_image"].'.jpg">'.$row["album_image"].'</a>';
                    echo '<br><img src="../assets/ressources/albums/'.$row["album_image"].'.jpg" width="157px" height="212px" class="align-self-start mr-3" alt="'.$row["album_image"].'">';
                    echo '<p></p>';
                    echo '<p><a onclick="window.location.href = \'jurons.php\';" class="btn btn-primary" role="button" href="#">Retour</a> <a class="btn btn-danger" role="button" href="javascript:Delete()">Supprimer</a></p>';
                }
            ?>       
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script language="javascript"> 
        function Delete() {
            $.post("confirm_suppr_album.php", { 
                album_ref: <?php echo '"'.$row["album_ref"].'"' ?>, 
                album_titre: <?php echo '"'.$row["album_titre"].'"' ?>, 
                album_parution: <?php echo '"'.$row["album_parution"].'"' ?>, 
                album_tome: <?php echo '"'.$row["album_tome"].'"' ?>, 
                album_image: <?php echo '"'.$row["album_image"].'"' ?>  
            });
            window.location.href = 'jurons.php';
        }
    </script>
</body>

</html>