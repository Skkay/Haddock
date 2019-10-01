<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");
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
            <h4>Ajouter un juron à une case</h4>
            <hr class="my-4">

            <!-- SELECTION DE L'ALBUM -->
            <form id="form_album" method="get" action="">
                <div class="form-group">
                    <label>Album :</label>
                    <select class="form-control" name="album" onchange="form_album.submit();">
                        <option disabled selected value>-</option>
                        <?php
                        $bdd_liste_album = $bdd->query("SELECT * FROM album");
                        while($row = $bdd_liste_album->fetch()) {
                            if (!empty($_GET) && $_GET["album"] == $row["album_ref"]) {
                                echo '<option value="'.$row["album_ref"].'" selected>'.$row["album_titre"].'</option>';
                            }
                            else {
                                echo '<option value="'.$row["album_ref"].'">'.$row["album_titre"].'</option>';
                            } 
                        }
                        ?>
                    </select>
                </div>
            </form>

            <!-- SELECTION DE LA PAGE -->
            <?php if (isset($_GET["album"])) { ?>            
            <form id="form_page" method="get" action="">
                <div class="form-group">
                    <label>Page :</label>
                    <?php echo '<input name="album" type="hidden" value="'.$_GET["album"].'">' ?>
                    <select class="form-control" name="page" onchange="form_page.submit();">
                        <option disabled selected value>-</option>
                        <?php
                        $ref_album = $_GET["album"];
                        $bdd_liste_page = $bdd->query("SELECT * FROM page WHERE ref_album LIKE '$ref_album'");
                        while($row = $bdd_liste_page->fetch()) {
                            
                            if (!empty($_GET) && $_GET["page"] == $row["page_num"]) {
                                echo '<option value="'.$row["page_num"].'" selected>'.$row["page_num"].'</option>';
                            }
                            else {
                                echo '<option value="'.$row["page_num"].'">'.$row["page_num"].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </form>
            <?php } ?>

            <!-- SELECTION DE LA BANDE -->
            <?php if (isset($_GET["album"]) AND isset($_GET["page"])) { ?>            
            <form id="form_bande" method="get" action="">
                <div class="form-group">
                    <label>Bande :</label>
                    <?php echo '<input name="album" type="hidden" value="'.$_GET["album"].'">' ?>
                    <?php echo '<input name="page" type="hidden" value="'.$_GET["page"].'">' ?>
                    <select class="form-control" name="bande" onchange="form_bande.submit();">
                        <option disabled selected value>-</option>
                        <?php
                        $ref_album = $_GET["album"];
                        $page = $_GET["page"];
                        $bdd_liste_bande = $bdd->query("SELECT * FROM bande WHERE ref_album LIKE '$ref_album' AND num_page = $page");
                        while($row = $bdd_liste_bande->fetch()) {
                            
                            if (!empty($_GET) && $_GET["bande"] == $row["bande_place"]) {
                                echo '<option value="'.$row["bande_place"].'" selected>'.$row["bande_place"].'</option>';
                            }
                            else {
                                echo '<option value="'.$row["bande_place"].'">'.$row["bande_place"].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </form>
            <?php } ?>

            <!-- SELECTION DE LA CASE -->
            <?php if (isset($_GET["album"]) AND isset($_GET["page"]) AND isset($_GET["bande"])) { ?>            
            <form id="form_case" method="get" action="">
                <div class="form-group">
                    <label>Case :</label>
                    <?php echo '<input name="album" type="hidden" value="'.$_GET["album"].'">' ?>
                    <?php echo '<input name="page" type="hidden" value="'.$_GET["page"].'">' ?>
                    <?php echo '<input name="bande" type="hidden" value="'.$_GET["bande"].'">' ?>
                    <select class="form-control" name="case" onchange="form_case.submit();">
                        <option disabled selected value>-</option>
                        <?php
                        $ref_album = $_GET["album"];
                        $page = $_GET["page"];
                        $bande = $_GET["bande"];
                        $bdd_liste_case = $bdd->query("SELECT * FROM case_bulle WHERE ref_album LIKE '$ref_album' AND num_page = $page AND place_bande LIKE '$bande'");
                        while($row = $bdd_liste_case->fetch()) {
                            
                            if (!empty($_GET) && $_GET["case"] == $row["case_num"]) {
                                echo '<option value="'.$row["case_num"].'" selected>'.$row["case_num"].'</option>';
                            }
                            else {
                                echo '<option value="'.$row["case_num"].'">'.$row["case_num"].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </form>
            <?php } ?>

            <!-- SELECTION DU JURON -->
            <?php if (isset($_GET["album"]) AND isset($_GET["page"]) AND isset($_GET["bande"]) AND isset($_GET["case"])) { ?>
            <form id="form_juron" method="get" action="">
                <div class="form-group">
                    <label>Juron :</label>
                    <?php echo '<input name="album" type="hidden" value="'.$_GET["album"].'">' ?>
                    <?php echo '<input name="page" type="hidden" value="'.$_GET["page"].'">' ?>
                    <?php echo '<input name="bande" type="hidden" value="'.$_GET["bande"].'">' ?>
                    <?php echo '<input name="case" type="hidden" value="'.$_GET["case"].'">' ?>
                    <select class="form-control" name="juron" onchange="form_juron.submit();">
                        <option disabled selected value>-</option>
                        <?php
                        $bdd_liste_juron = $bdd->query("SELECT * FROM jurons ORDER BY jurons_texte");
                        while($row = $bdd_liste_juron->fetch()) {
                            
                            if (!empty($_GET) && $_GET["juron"] == $row["jurons_num"]) {
                                echo '<option value="'.$row["jurons_num"].'" selected>'.$row["jurons_texte"].'</option>';
                            }
                            else {
                                echo '<option value="'.$row["jurons_num"].'">'.$row["jurons_texte"].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </form>
            <?php } ?>

            <!-- VALIDATION -->
            <?php if (isset($_GET["album"]) AND isset($_GET["page"]) AND isset($_GET["bande"]) AND isset($_GET["case"]) AND isset($_GET["juron"])) { ?>
            <form id="form_validation" method="post" action="confirm_ajouter.php">
                <div class="form-group">
                    <?php echo '<input name="ref_album" type="hidden" value="'.$_GET["album"].'">' ?>
                    <?php echo '<input name="num_page" type="hidden" value="'.$_GET["page"].'">' ?>
                    <?php echo '<input name="place_bande" type="hidden" value="'.$_GET["bande"].'">' ?>
                    <?php echo '<input name="num_case" type="hidden" value="'.$_GET["case"].'">' ?>
                    <?php echo '<input name="jurons_num" type="hidden" value="'.$_GET["juron"].'">' ?>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php } ?>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>