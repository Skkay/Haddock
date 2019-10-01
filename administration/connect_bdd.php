<?php
    ChromePhp::log('Hello console !');
    // Connexion à la BDD
    error_reporting(0);

    try {
        $bdd = new PDO("mysql:host=localhost;dbname=haddock_base;charset=utf8", "root", "");
    }
    catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
?>