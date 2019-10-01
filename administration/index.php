<?php
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd_user.php");

    if (isset($_POST["identifiant"]) AND isset($_POST["password"])) 
    {   
        $identifiant = $_POST["identifiant"];
        $password = $_POST["password"];
        unset($_POST["identifiant"]);
        unset($_POST["password"]);

        $bdd_identifiant = $bdd->query("
            SELECT * FROM user WHERE identifiant LIKE '$identifiant'
        ");
        $row = $bdd_identifiant->fetch();

        $isPasswordCorrect = password_verify($password, $row["password"]);

        if (!$row) 
        {
            // Identifiant incorrect
            //ChromePhp::log("Identifiant ou mot de passe incorrect.");
            $correct = false;
        }
        else 
        {
            if ($isPasswordCorrect) 
            {
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION["identifiant"] = $identifiant;
                //ChromePhp::log("Connecté");
                $correct = true;
            }
            else
            {
                // Mot de passe incorrect
                //ChromePhp::log("Identifiant ou mot de passe incorrect.");
                $correct = false;
            }
        }
    }
       
?>


<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($correct) { echo '<meta http-equiv="refresh" content="3;url=home.php" />'; } ?>
    <title>Untitled</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

    <?php include("../include/navbar.php"); ?>

    <p><br></p>
    
    <div class="container">
        <div class="jumbotron">
            <h4>Administration</h4>
            <hr class="my-4">
            <?php
                if (!$correct) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Identifiant ou mot de passe incorrect !';
                    echo '</div>';
                }
                else {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Connecté ! Redirection dans <span id="countdown">3</span> secondes...';
                    echo '</div>';
                }
            ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Connexion</div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group row">
                                    <label for="identifiant" class="col-md-4 col-form-label text-md-right">Identifiant</label>
                                    <div class="col-md-6">
                                        <input type="text" id="identifiant" class="form-control" name="identifiant" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Connexion</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <?php if($correct) { ?>
        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function() {
                timeleft--;
                document.getElementById("countdown").textContent = timeleft;
                if(timeleft <= 0) {
                    clearInterval(downloadTimer);
                }
            }, 1000);
        </script>
    <?php } ?>   
</body>
</html>