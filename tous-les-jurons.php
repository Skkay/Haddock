<?php
    include("assets/chromephp-master/ChromePhp.php");
    include("administration/connect_bdd.php");
?>


<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

    <?php include("include/navbar.php"); ?>

    <p><br></p>
    
    <div class="container">
        <div class="jumbotron">
            <h3>Tous les jurons du Capitaine Haddock</h3>
            <p>Tu trouveras ici la liste de tous les jurons que le Capitaine Haddock a pu dire.</p>
            <ul>
                <?php
                    $results_per_page = 50;

                    if(isset($_GET["page"])) {
                        $page = $_GET["page"];
                    }
                    else {
                        $page = 1;
                    }
                    $start_from = ($page-1) * $results_per_page;

                    $result = $bdd->query("
                        SELECT COUNT(jurons_texte) 
                        AS total 
                        FROM jurons
                    ");
                    $row = $result->fetch();
                    $total_pages = ceil($row["total"] / $results_per_page);

                    $bdd_jurons = $bdd->query("
                        SELECT jurons.jurons_texte
                        FROM jurons
                        ORDER BY jurons.jurons_texte
                        ASC LIMIT $start_from, ".$results_per_page
                    );

                    while($row = $bdd_jurons->fetch()) {
                        echo '<li>'.$row["jurons_texte"].'</li>';
                    }
                ?>
            </ul>
            <nav aria-label="page_pagination">
                <ul class="pagination justify-content-center">
                    <?php 
                    // Bouton précédent
                    if ($page == 1) {
                        echo "<li class='page-item disabled'><a class='page-link' href='#'><span aria-hidden='true'>&laquo;</span></a>";
                    }
                    else {
                        $prev_page = $page-1;
                        echo "<li class='page-item'><a class='page-link' href='tous-les-jurons.php?page=".$prev_page."'><span aria-hidden='true'>&laquo;</span></a>";
                    }

                    // Boutons chiffrés
                    for ($i=1; $i<=$total_pages; $i++) {
                        if ($i == $page) {
                            echo "<li class='page-item active'><a class='page-link' href='tous-les-jurons.php?page=".$i."'>".$i."</a>";
                        }
                        else {
                            echo "<li class='page-item'><a class='page-link' href='tous-les-jurons.php?page=".$i."'>".$i."</a>";
                        }  
                    }

                    // Boutton suivant
                    if ($page == $total_pages) {
                        echo "<li class='page-item disabled'><a class='page-link' href='#'><span aria-hidden='true'>&raquo;</span></a>";
                    }
                    else {
                        $next_page = $page+1;
                        echo "<li class='page-item'><a class='page-link' href='tous-les-jurons.php?page=".$next_page."'><span aria-hidden='true'>&raquo;</span></a>";
                    } 
                    ?>
                </ul>
            </nav>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>