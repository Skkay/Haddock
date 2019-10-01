<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    $ref_album = $_POST["album"];
    $page = $_POST["page"];
    $bande = $_POST["bande"];

    $bdd_jurons_ajouter = $bdd->prepare("
        INSERT INTO bande(bande_place, num_page, ref_album)
        VALUES (:bande, :page, :ref)
    ");

    $bdd_jurons_ajouter->execute(array(
        "bande" => $bande,
        "page" => $page,
        "ref" => $ref_album
    ));
    ChromePhp::log($bdd->errorInfo());
    $_SESSION["add_bande"] = true;

    $_SESSION["add_bande_ref"] = $ref_album;
    $_SESSION["add_bande_page"] = $page;
    $_SESSION["add_bande_bande"] = $bande;
        
    header('Location: /Haddock/administration/jurons.php');
    exit();
?>
