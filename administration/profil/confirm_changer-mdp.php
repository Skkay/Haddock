<?php
    include("../../assets/chromephp-master/ChromePhp.php");
    include("../connect_bdd_user.php");
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }

    $old_mdp = $_POST["old"];
	$new_mdp = $_POST["new"];
	$confirm_new_mdp = $_POST["confirm_new"];
	$id = $_SESSION["id"];

	$bdd_identifiant = $bdd->query("
        SELECT * FROM user WHERE id LIKE '$id'
    ");
    $row = $bdd_identifiant->fetch();

    $isPasswordCorrect = password_verify($old_mdp, $row["password"]);

    if (!$row) 
    {
        // Identifiant incorrect
        ChromePhp::log("Identifiant ou mot de passe incorrect.");
        $_SESSION["changer-mdp"] = -1;
    }
    else 
    {
        if ($isPasswordCorrect) 
        {
            if ($new_mdp == $confirm_new_mdp) 
            {
            	$req = $bdd->prepare("
            		UPDATE user
            		SET password = :new
            		WHERE id = :id_user
            	");
            	$req->execute(array(
            		"new" => password_hash($new_mdp, PASSWORD_DEFAULT),
            		"id_user" => $_SESSION["id"]
            	));
            	ChromePhp::log("Mot de passe modifié");
            	$_SESSION["changer-mdp"] = 1;
            }
            else 
            {
				ChromePhp::log("Le nouveau mot de passe ne correspond pas à la confirmation.");
				$_SESSION["changer-mdp"] = 2;
            }
        }
        else
        {
            // Mot de passe incorrect
            ChromePhp::log("Identifiant ou mot de passe incorrect.");
            $_SESSION["changer-mdp"] = -1;
        }
    }
    header('Location: changer-mdp.php');
    exit();
?>