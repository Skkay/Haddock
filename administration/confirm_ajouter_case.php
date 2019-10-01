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
    $case_num = $_POST["case"];

    $bdd_jurons_ajouter = $bdd->prepare("
        INSERT INTO case_bulle(case_num, place_bande, num_page, ref_album)
        VALUES (:case_num, :bande, :page, :ref)
    ");

    $bdd_jurons_ajouter->execute(array(
        "case_num" => $case_num,
        "bande" => $bande,
        "page" => $page,
        "ref" => $ref_album
    ));
    
    $_SESSION["add_case"] = true;

    $_SESSION["add_case_ref"] = $ref_album;
    $_SESSION["add_case_page"] = $page;
    $_SESSION["add_case_bande"] = $bande;
    $_SESSION["add_case_case_num"] = $case_num;
        
    header('Location: /Haddock/administration/jurons.php');
    exit();
?>
