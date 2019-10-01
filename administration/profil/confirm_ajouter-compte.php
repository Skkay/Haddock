<?php
    include("../../assets/chromephp-master/ChromePhp.php");
    include("../connect_bdd_user.php");
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }

    $identifiant = $_POST["identifiant"];
	$password = $_POST["password"];
	$confirm_password = $_POST["confirm_password"];

    $bdd_identifiant = $bdd->query("
        SELECT identifiant 
        FROM user 
        WHERE identifiant LIKE '$identifiant'
    ");
    $row = $bdd_identifiant->fetch();

    // Si mot de passe et confirmation OK
    if ($password == $confirm_password) {
        
        // Si le pseudo n'existe pas dans la base, l'ajoute
        if (!$row) { 

            $bdd_ajout_user = $bdd->prepare("
                INSERT INTO user(identifiant, password)
                VALUES (:identifiant, :password)
            ");
            ChromePhp::log($bdd->errorInfo());
            $bdd_ajout_user->execute(array(
                "identifiant" => $identifiant,
                "password" => password_hash($password, PASSWORD_DEFAULT)
            ));
            $_SESSION["ajout-compte"] = 1;
        }
        else {
            $_SESSION["ajout-compte"] = 2;
        }
    }
    else {
        $_SESSION["ajout-compte"] = -1;
    }
    header('Location: ajouter-compte.php');
    exit();
?>