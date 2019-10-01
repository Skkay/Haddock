<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }
    include("../../assets/chromephp-master/ChromePhp.php");
    include("../connect_bdd_user.php");
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
            <?php 
                
            ?>
            <h4>Compte</h4>
            <hr class="my-4">
            <?php
                /*
                 * -3 : ID inéxistant
                 * -2 : Vous devez être connecté avec le compte principal
                 * -1 : Impossible de supprimer le compte principal
                 *  1 : Compte supprimé
                 */
                if ($_SESSION["suppr-compte"] == -3) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'Compte inéxistant.';
                    echo '</div>';
                }
                else if ($_SESSION["suppr-compte"] == -2) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Vous devez être connecté avec le compte administrateur principal !';
                    echo '</div>';
                }

                else if ($_SESSION["suppr-compte"] == -1) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Impossible de supprimer le compte administrateur principal !';
                    echo '</div>';
                }
                else if ($_SESSION["suppr-compte"] == 1) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Compte supprimé.';
                    echo '</div>';
                }
                unset($_SESSION["suppr-compte"]);
            ?>
            <!-- TABLE COMPTE -->
            <div class="table-responsive">
                <?php
                    $bdd_albums = $bdd->query("
                        SELECT *
                        FROM user
                    ");
                ?>
                <table class="table table-hover table-sm" id="table_albums">
                    <thead>
                        <tr>
                            <th style="text-align: center">ID</th>
                            <th>Identifiant</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $bdd_albums->fetch()) {
                                echo '<tr>';
                                echo '<td style="text-align: center">'.$row["id"].'</td>';
                                echo '<td>'.$row["identifiant"].'</td>';
                                echo '<td><a href="confirm_suppr-compte.php?id='.$row["id"].'" style="color: #C3303E;">Supprimer</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/floatThead.min.js"></script>
</body>

</html>