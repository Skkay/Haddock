<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        exit();
    }
    include("../assets/chromephp-master/ChromePhp.php");
    include("connect_bdd.php");
?>

<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

    <?php include("../include/navbar.php"); ?>

    <p><br></p>
    
    <div class="container-fluid">
        <div class="jumbotron">
            <?php 
                if ($_SESSION["delete"] == true) { 
                    $_SESSION["delete"] = false;
                
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément supprimé :</h4>';
                    echo '<strong>Juron :</strong> <i>'.$_SESSION["del_jurons_texte"].'</i><br>';
                    echo '<strong>Album :</strong> <i>'.$_SESSION["del_ref_album"].'</i><br>';
                    echo '<strong>Page :</strong> <i>'.$_SESSION["del_num_page"].'</i><br>';
                    echo '<strong>Bande :</strong> <i>'.$_SESSION["del_place_bande"].'</i><br>';
                    echo '<strong>Case :</strong> <i>'.$_SESSION["del_num_case"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["add"] == true) { 
                    $_SESSION["add"] = false;
                
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément ajouté :</h4>';
                    echo '<strong>Juron :</strong> <i>'.$_SESSION["add_jurons_texte"].'</i><br>';
                    echo '<strong>Album :</strong> <i>'.$_SESSION["add_ref_album"].'</i><br>';
                    echo '<strong>Page :</strong> <i>'.$_SESSION["add_num_page"].'</i><br>';
                    echo '<strong>Bande :</strong> <i>'.$_SESSION["add_place_bande"].'</i><br>';
                    echo '<strong>Case :</strong> <i>'.$_SESSION["add_num_case"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["add_album"] == true) {
                    $_SESSION["add_album"] = false;

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément ajouté :</h4>';
                    echo '<strong>Titre :</strong> <i>'.$_SESSION["add_album_titre"].'</i><br>';
                    echo '<strong>Référence :</strong> <i>'.$_SESSION["add_album_ref"].'</i><br>';
                    echo '<strong>Parution :</strong> <i>'.$_SESSION["add_album_parution"].'</i><br>';
                    echo '<strong>Tome :</strong> <i>'.$_SESSION["add_album_tome"].'</i><br>';
                    echo '<strong>Nom de l\'image :</strong> <i>'.$_SESSION["add_album_image"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["add_page"] == true) {
                    $_SESSION["add_page"] = false;

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément ajouté :</h4>';
                    echo '<strong>Page :</strong> <i>'.$_SESSION["add_page_page"].'</i><br>';
                    echo '<strong>A l\'album :</strong> <i>'.$_SESSION["add_page_ref"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["add_bande"] == true) {
                    $_SESSION["add_bande"] = false;

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément ajouté :</h4>';
                    echo '<strong>Bande :</strong> <i>'.$_SESSION["add_bande_bande"].'</i><br>';
                    echo '<strong>A la page :</strong> <i>'.$_SESSION["add_bande_page"].'</i><br>';
                    echo '<strong>A l\'album :</strong> <i>'.$_SESSION["add_bande_ref"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["add_case"] == true) {
                    $_SESSION["add_case"] = false;

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément ajouté :</h4>';
                    echo '<strong>Case :</strong> <i>'.$_SESSION["add_case_case_num"].'</i><br>';
                    echo '<strong>A la bande :</strong> <i>'.$_SESSION["add_case_bande"].'</i><br>';
                    echo '<strong>A la page :</strong> <i>'.$_SESSION["add_case_page"].'</i><br>';
                    echo '<strong>A l\'album :</strong> <i>'.$_SESSION["add_case_ref"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["add_juron"] == true) {
                    $_SESSION["add_juron"] = false;

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément ajouté :</h4>';
                    echo '<strong>Juron :</strong> <i>'.$_SESSION["add_juron_juron"].'</i><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }

                if ($_SESSION["delete_album"] == true) { 
                    $_SESSION["delete_album"] = false;
                
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo '<h4>Élément supprimé :</h4>';
                    echo '<strong>Album :</strong> <i>'.$_SESSION["del_album_album_titre"].'</i><br>';
                    echo '<strong>Référence :</strong> <i>'.$_SESSION["del_album_album_ref"].'</i><br>';
                    echo '<strong>Parution :</strong> <i>'.$_SESSION["del_album_album_parution"].'</i><br>';
                    echo '<strong>Tome :</strong> <i>'.$_SESSION["del_album_album_tome"].'</i><br>';
                    //echo '<strong>Image :</strong> <a target="_blank" href="../assets/ressources/albums/'.$_SESSION["del_album_album_image"].'.jpg"><i>'.$_SESSION["del_album_album_image"].'</i></a><br>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                }
            ?>

            <h1>Albums et jurons</h1>
            <hr class="my-4">
            <div style="text-align: center;">
                <a href="#albums" class="btn btn-sm btn-outline-primary">Albums</a> - 
                <a href="#jurons" class="btn btn-sm btn-outline-primary">Jurons</a> - 
                <a href="ajouter.php" class="btn btn-sm btn-outline-success">Ajouter un juron à une case</a> - 
                <a href="ajouter_album.php" class="btn btn-sm btn-outline-success">Ajouter un album</a> - 
                <a href="ajouter_page.php" class="btn btn-sm btn-outline-success">Ajouter une page</a> - 
                <a href="ajouter_bande.php" class="btn btn-sm btn-outline-success">Ajouter une bande</a> - 
                <a href="ajouter_case.php" class="btn btn-sm btn-outline-success">Ajouter une case</a> - 
                <a href="ajouter_juron.php" class="btn btn-sm btn-outline-success">Ajouter un juron</a>
            </div>
            <hr class="my-4">
            <p><br></p>

            <!-- TABLE ALBUMS -->
            <h4 id="albums">Les albums</h4>
            <hr class="my-4">
            <input type="text" class="form-control" id="searchTable_albums" onkeyup="searchTableFunction_albums()" placeholder="Chercher un album...">
            <div class="table-responsive">
                <?php
                    $bdd_albums = $bdd->query("
                        SELECT album.album_ref, album.album_titre, album.album_parution, album.album_tome, album.album_image
                        FROM album
                        ORDER BY album.album_titre
                    ");
                ?>
                <table class="table table-hover table-sm" id="table_albums">
                    <thead>
                        <tr>
                            <th style="text-align: center">Référence</th>
                            <th>Titre</th>
                            <th style="text-align: center">Parution</th>
                            <th style="text-align: center">Tome</th>
                            <th style="text-align: center">Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $bdd_albums->fetch()) {
                                echo '<tr>';
                                echo '<td style="text-align: center">'.$row["album_ref"].'</td>';
                                echo '<td>'.$row["album_titre"].'</td>';
                                echo '<td style="text-align: center">'.$row["album_parution"].'</td>';
                                echo '<td style="text-align: center">'.$row["album_tome"].'</td>';
                                echo '<td style="text-align: center"><a target="_blank" href="../assets/ressources/albums/'.$row["album_image"].'.jpg">'.$row["album_image"].'</td>';
                                echo '<td><a href="suppr_album.php?album='.$row["album_ref"].'" style="color: #C3303E;">Supprimer</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <p><br></p>

            <!-- TABLE JURONS -->
            <h4 id="jurons">Les jurons</h4>
            <hr class="my-4">
            <input type="text" class="form-control" id="searchTable_jurons" onkeyup="searchTableFunction_jurons()" placeholder="Chercher un juron...">
            <div class="table-responsive">
                <?php
                    $bdd_jurons = $bdd->query("
                        SELECT jurons.jurons_texte, jurons.jurons_num, se_trouver_bulle.num_case, se_trouver_bulle.place_bande, se_trouver_bulle.num_page, se_trouver_bulle.ref_album, album.album_titre
                        FROM jurons, se_trouver_bulle, album
                        WHERE jurons.jurons_num = se_trouver_bulle.jurons_num
                        AND se_trouver_bulle.ref_album LIKE album.album_ref
                        ORDER BY jurons.jurons_texte
                    ");
                ?>
                <table class="table table-hover table-sm" id="table_jurons">
                    <thead>
                        <tr>
                            <th>Juron</th>
                            <th style="text-align: center">Case</th>
                            <th style="text-align: center">Bande</th>
                            <th style="text-align: center">Page</th>
                            <th style="text-align: center">Référence album</th>
                            <th>Titre album</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $bdd_jurons->fetch()) {
                                echo '<tr>';
                                echo '<td>'.$row["jurons_texte"].'</td>';
                                echo '<td style="text-align: center">'.$row["num_case"].'</td>';
                                echo '<td style="text-align: center">'.$row["place_bande"].'</td>';
                                echo '<td style="text-align: center">'.$row["num_page"].'</td>';
                                echo '<td style="text-align: center">'.$row["ref_album"].'</td>';
                                echo '<td>'.$row["album_titre"].'</td>';
                                //echo '<td><a href="#" style="color: #1178F1;">Modifier</a></td>';
                                echo '<td><a href="suppr.php?num='.$row["jurons_num"].'&case='.$row["num_case"].'&bande='.$row["place_bande"].'&page='.$row["num_page"].'&album='.$row["ref_album"].'" style="color: #C3303E;">Supprimer</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/floatThead.min.js"></script>
    <script>
        $("table").floatThead({
            responsiveContainer: function($table){
                return $table.closest(".table-responsive");
            }
        });

        function searchTableFunction_jurons() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchTable_jurons");
            filter = input.value.toUpperCase();
            table = document.getElementById("table_jurons");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } 
                    else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        function searchTableFunction_albums() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchTable_albums");
            filter = input.value.toUpperCase();
            table = document.getElementById("table_albums");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } 
                    else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

    </script>
</body>

</html>