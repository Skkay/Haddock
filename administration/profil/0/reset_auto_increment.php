<?php
	session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: ../index.php');
        exit();
    }
    include("../../../assets/chromephp-master/ChromePhp.php");
    include("../../connect_bdd_user.php");

    $bdd_reset = $bdd->query("
        ALTER TABLE user AUTO_INCREMENT = 1
    ");
    echo 'auto_increment reset';
?>