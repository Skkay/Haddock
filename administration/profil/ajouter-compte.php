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
            <h4>Compte</h4>
            <hr class="my-4"> 
            <?php
                /*
                 * -1 : Mot de passe correspond pas à la confirmation
                 *  2 : L'identifiant est déjà utilisé
                 *  1 : Compte ajouter
                 */
                if ($_SESSION["ajout-compte"] == -1) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'Le mot de passe ne correspond pas à la confirmation.';
                    echo '</div>';
                }
                else if ($_SESSION["ajout-compte"] == 2) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'Cet identifiant est déjà utilisé.';
                    echo '</div>';
                }

                else if ($_SESSION["ajout-compte"] == 1) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Compte ajouté';
                    echo '</div>';
                }
                unset($_SESSION["ajout-compte"]);
            ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Ajouter un compte</div>
                        <div class="card-body">

                            <form method="post" action="confirm_ajouter-compte.php">
                                <div class="form-group row">
                                    <label for="identifiant" class="col-md-4 col-form-label text-md-right">Identifiant</label>
                                    <div class="col-md-6">
                                        <input type="text" id="identifiant" class="form-control" name="identifiant" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirmé mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Créer</button>
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