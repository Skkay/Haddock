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

    $bdd_jurons_suppr = $bdd->query("
        DELETE FROM se_trouver_bulle
        WHERE se_trouver_bulle.num_case = '$num_case'
        AND se_trouver_bulle.place_bande LIKE '$place_bande'
        AND se_trouver_bulle.num_page = '$num_page'
        AND se_trouver_bulle.ref_album LIKE '$ref_album'
    ");
    
    if ($bdd_jurons_suppr->rowCount() > 0){
        ChromePhp::log("Element supprimé avec succès.");
        $_SESSION["delete"] = true;

        $_SESSION["del_jurons_num"] = $jurons_num;
        $_SESSION["del_num_case"] = $num_case;
        $_SESSION["del_place_bande"] = $place_bande;
        $_SESSION["del_num_page"] = $num_page;
        $_SESSION["del_ref_album"] = $ref_album;

        $bdd_jurons_texte = $bdd->query("
        	SELECT jurons.jurons_texte FROM jurons WHERE jurons.jurons_num = $jurons_num
        ");
        while ($row = $bdd_jurons_texte->fetch()) {
        	$_SESSION["del_jurons_texte"] = $row["jurons_texte"];
        }
    }
    else {
        ChromePhp::log("Erreur lors de la suppression");
    }
?>
