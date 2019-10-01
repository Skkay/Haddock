<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    $album_ref = $_POST["album_ref"];
    $album_titre = $_POST["album_titre"];
    $album_parution = $_POST["album_parution"];
    $album_tome = $_POST["album_tome"];
    $album_image = $_POST["album_image"];

    $bdd_jurons_suppr = $bdd->query("
        DELETE FROM album
        WHERE album.album_ref LIKE '$album_ref'
    ");
    
    if ($bdd_jurons_suppr->rowCount() > 0){
        ChromePhp::log("Element supprimé avec succès.");
        $_SESSION["delete_album"] = true;

        $_SESSION["del_album_album_ref"] = $album_ref;
        $_SESSION["del_album_album_titre"] = $album_titre;
        $_SESSION["del_album_album_parution"] = $album_parution;
        $_SESSION["del_album_album_tome"] = $album_tome;
        $_SESSION["del_album_album_image"] = $album_image;
    }
    else {
        ChromePhp::log("Erreur lors de la suppression");
    }
?>
