<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    $ref_album = $_POST["ref"];
    $page = $_POST["page"];

    ChromePhp::log("Ref:");
    ChromePhp::log($ref_album);

    $bdd_jurons_ajouter = $bdd->prepare("
        INSERT INTO page(page_num, ref_album)
        VALUES (:page, :ref)
    ");
    ChromePhp::log($bdd->errorInfo());
    $bdd_jurons_ajouter->execute(array(
        "page" => $page,
        "ref" => $ref_album
    ));
    ChromePhp::log($bdd->errorInfo());
    $_SESSION["add_page"] = true;

    $_SESSION["add_page_ref"] = $ref_album;
    $_SESSION["add_page_page"] = $page;
        
    header('Location: /Haddock/administration/jurons.php');
    exit();
?>
