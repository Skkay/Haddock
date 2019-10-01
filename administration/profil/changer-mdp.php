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
            <h4>Mot de passe</h4>
            <hr class="my-4"> 
            <?php
                /*
                 * -1 : Mot de passe incorrect
                 *  2 : Nouveau mot de passe correspond pas à la confirmation
                 *  1 : Mot de passe modifié
                 */
                if ($_SESSION["changer-mdp"] == -1) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Identifiant ou mot de passe incorrect !';
                    echo '</div>';
                }
                else if ($_SESSION["changer-mdp"] == 2) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'Le nouveau mot de passe ne correspond pas à la confirmation.';
                    echo '</div>';
                }

                else if ($_SESSION["changer-mdp"] == 1) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Mot de passe modifié.';
                    echo '</div>';
                }
                unset($_SESSION["changer-mdp"]);
            ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Changer de mot de passe</div>
                        <div class="card-body">

                            <form method="post" action="confirm_changer-mdp.php">
                                <div class="form-group row">
                                    <label for="old" class="col-md-4 col-form-label text-md-right">Ancien mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="old" class="form-control" name="old" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new" class="col-md-4 col-form-label text-md-right">Nouveau mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="new" class="form-control" name="new" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_new" class="col-md-4 col-form-label text-md-right">Confirmé nouveau mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm_new" class="form-control" name="confirm_new" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>