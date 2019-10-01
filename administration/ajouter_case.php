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
            <h4>Nouvelle case</h4>
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
            <form id="form_case" method="post" action="confirm_ajouter_case.php">
                <div class="form-group">
                    <label>Case :</label>
                    <?php echo '<input name="album" type="hidden" value="'.$_GET["album"].'">' ?>
                    <?php echo '<input name="page" type="hidden" value="'.$_GET["page"].'">' ?>
                    <?php echo '<input name="bande" type="hidden" value="'.$_GET["bande"].'">' ?>
                    <input type="number" class="form-control" placeholder="" name="case" required="true" min="0">
                    <small class="form-text text-muted">Doit contenir le numéro de la case</small>
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