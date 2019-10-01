<?php
    session_start();

    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    $jurons_num = $_POST["jurons_num"];
    $num_case = $_POST["num_case"];
    $place_bande = $_POST["place_bande"];
    $num_page = $_POST["num_page"];
    $ref_album = $_POST["ref_album"];

    ChromePhp::log($jurons_num);

    $bdd_jurons_ajouter = $bdd->prepare("
        INSERT INTO se_trouver_bulle(num_case, num_page, place_bande, ref_album, jurons_num)
        VALUES (:num_case, :num_page, :place_bande, :ref_album, :jurons_num)
    ");
    $bdd_jurons_ajouter->execute(array(
        "num_case" => $num_case,
        "num_page" => $num_page,
        "place_bande" => $place_bande,
        "ref_album" => $ref_album,
        "jurons_num" => $jurons_num,
    ));
    $_SESSION["add"] = true;

    $_SESSION["add_jurons_num"] = $jurons_num;
    $_SESSION["add_num_case"] = $num_case;
    $_SESSION["add_place_bande"] = $place_bande;
    $_SESSION["add_num_page"] = $num_page;
    $_SESSION["add_ref_album"] = $ref_album;

    $bdd_jurons_texte = $bdd->query("
        SELECT jurons.jurons_texte FROM jurons WHERE jurons.jurons_num = $jurons_num
    ");
    while ($row = $bdd_jurons_texte->fetch()) {
        $_SESSION["add_jurons_texte"] = $row["jurons_texte"];
    }
        
    header('Location: /Haddock/administration/jurons.php');
    exit();
?>
