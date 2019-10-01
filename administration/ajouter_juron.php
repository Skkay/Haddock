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
            <h4>Nouveau juron</h4>
            <hr class="my-4">

            <form method="post" action="confirm_ajouter_juron.php">
                <div class="form-group">
                    <label>Ajouter un nouveau juron :</label>
                    <input type="text" class="form-control" placeholder="Juron" name="juron" required="true">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>

        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>