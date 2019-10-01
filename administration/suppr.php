<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    if (!isset($_GET["num"]) OR !isset($_GET["case"]) OR !isset($_GET["bande"]) OR !isset($_GET["page"]) OR !isset($_GET["album"])) {
        //header('Location: /Haddock/administration');
        //exit();
    }
    else {
        $jurons_num = $_GET["num"];
        $num_case = $_GET["case"];
        $place_bande = $_GET["bande"];
        $num_page = $_GET["page"];
        $ref_album = $_GET["album"];

        $bdd_jurons = $bdd->query("
            SELECT jurons.jurons_texte, jurons.jurons_num, se_trouver_bulle.num_case, se_trouver_bulle.place_bande, se_trouver_bulle.num_page, se_trouver_bulle.ref_album, album.album_titre
            FROM jurons, se_trouver_bulle, album
            WHERE jurons.jurons_num = '$jurons_num'
            AND se_trouver_bulle.num_case = '$num_case'
            AND se_trouver_bulle.place_bande LIKE '$place_bande'
            AND se_trouver_bulle.num_page = '$num_page'
            AND se_trouver_bulle.ref_album LIKE '$ref_album'
            AND jurons.jurons_num = se_trouver_bulle.jurons_num
            AND album.album_ref = se_trouver_bulle.ref_album
        ");
        $row = $bdd_jurons->fetch();
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

                    echo '<b>Juron : </b>'.$row["jurons_texte"].' ('.$row["jurons_num"].')';
                    echo '<br><b>Album : </b>'.$row["album_titre"].' ('.$row["ref_album"].')';
                    echo '<br><b>Page : </b>'.$row["num_page"];
                    echo '<br><b>Bande : </b>'.$row["place_bande"];
                    echo '<br><b>Case : </b>'.$row["num_case"];
                    
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
            $.post("confirm_suppr.php", { 
                jurons_num: <?php echo '"'.$jurons_num.'"' ?>, 
                num_case: <?php echo '"'.$num_case.'"' ?>, 
                place_bande: <?php echo '"'.$place_bande.'"' ?>, 
                num_page: <?php echo '"'.$num_page.'"' ?>, 
                ref_album: <?php echo '"'.$ref_album.'"' ?> 
            });
            window.location.href = 'jurons.php';
        }
    </script>
</body>

</html>