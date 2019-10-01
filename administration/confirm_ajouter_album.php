<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");

    $titre = $_POST["titre"];
    $image = $_POST["image"];
    $tome = $_POST["tome"];
    $parution = $_POST["parution"];
    $ref_album = $_POST["ref"];

    ChromePhp::log($jurons_num);

    $bdd_jurons_ajouter = $bdd->prepare("
        INSERT INTO album(album_ref, album_titre, album_parution, album_tome, album_image)
        VALUES (:ref, :titre, :parution, :tome, :image)
    ");
    $bdd_jurons_ajouter->execute(array(
        "ref" => $ref_album,
        "titre" => $titre,
        "parution" => $parution,
        "tome" => $tome,
        "image" => $image,
    ));
    $_SESSION["add_album"] = true;

    $_SESSION["add_album_ref"] = $ref_album;
    $_SESSION["add_album_titre"] = $titre;
    $_SESSION["add_album_parution"] = $parution;
    $_SESSION["add_album_tome"] = $tome;
    $_SESSION["add_album_image"] = $image;
        
    header('Location: /Haddock/administration/jurons.php');
    exit();
?>
