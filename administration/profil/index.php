<?php
    include("../../assets/chromephp-master/ChromePhp.php");
    include("../connect_bdd.php");
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }
?>


<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
</head>

<body>

    <?php include("../../include/navbar.php"); ?>

    <p><br></p>
    
    <div class="container">
        <div class="jumbotron">
            <h1>Gestion de compte</h1>
            <hr class="my-4"> 
            <p>Actuellement connecté en tant que : <b><?php echo $_SESSION["identifiant"]; ?></b></p>
            <ul>
                <li><a href="changer-mdp.php">Changer de mot de passe</a></li>
                <li><a href="ajouter-compte.php">Ajouter un compte</a></li>
                <li><a href="suppr-compte.php">Supprimer un compte</a></li>
            </ul>
        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>