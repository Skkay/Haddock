<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    $juron = $_POST["juron"];

    $bdd_jurons_ajouter = $bdd->prepare("
        INSERT INTO jurons(jurons_texte)
        VALUES (:texte)
    ");

    $bdd_jurons_ajouter->execute(array(
        "texte" => $juron
    ));
    
    $_SESSION["add_juron"] = true;

    $_SESSION["add_juron_juron"] = $juron;
        
    header('Location: /Haddock/administration/jurons.php');
    exit();
?>
