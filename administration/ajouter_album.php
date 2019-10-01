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
            <h4>Nouvel Album</h4>
            <hr class="my-4">

            <form method="post" action="confirm_ajouter_album.php">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Titre de l'album :</label>
                        <input type="text" class="form-control" placeholder="" name="titre" required="true">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Référence :</label>
                        <input type="text" class="form-control" placeholder="" name="ref" required="true">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Année de parution</label>
                        <input type="number" class="form-control" placeholder="" name="parution" required="true" min="1900" max="2100">
                    </div>

                    <div class="form-group col-md-1">
                        <label>N° tome :</label>
                        <input type="number" class="form-control" placeholder="" name="tome" required="true" min="0">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Nom de l'image</label>
                        <input type="text" class="form-control" placeholder="Tintin_XX" name="image" required="true">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>

        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>