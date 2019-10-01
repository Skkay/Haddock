<?php
    include("../../assets/chromephp-master/ChromePhp.php");
    include("../connect_bdd_user.php");
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }
    
    $id = $_GET["id"];

    if ($id == 1) {
    	// Impossible de supprimer le compte principal
    	$_SESSION["suppr-compte"] = -1;
    }
    else {
    	if ($_SESSION["id"] == 1) {
    		// Connecté en tant que admin principal
    		$bdd_id = $bdd->query("
    			SELECT *
    			FROM user
    			WHERE id = '$id'
    		");
    		$row = $bdd_id->fetch();

    		if ($row) {
    			// ID éxistant
				$bdd_suppr = $bdd->query("
					DELETE FROM user
					WHERE id = '$id'
	    		");
	    		$_SESSION["suppr-compte"] = 1;
    		}
    		else {
    			// ID inéxistant
    			$_SESSION["suppr-compte"] = -3;
    		}
    	}
    	else {
    		// Vous devez être connecté avec le compte principal
    		$_SESSION["suppr-compte"] = -2;
    	}
    }
    header('Location: suppr-compte.php');
    exit();
?>