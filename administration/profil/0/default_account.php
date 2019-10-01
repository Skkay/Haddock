<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }
    include("../../../assets/chromephp-master/ChromePhp.php");
    include("../../connect_bdd_user.php");

    $bdd_default_account = $bdd->prepare("
    	INSERT INTO user(identifiant, password) 
    	VALUES (:identifiant, :password)
    ");

    $bdd_default_account->execute(array(
    	"identifiant" => "admin",
    	"password" => password_hash("admin", PASSWORD_DEFAULT)
    ));
    echo 'default account : admin admin';
?>