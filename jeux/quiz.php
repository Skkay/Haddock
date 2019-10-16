<?php
    include("../assets/chromephp-master/ChromePhp.php");
    include("../administration/connect_bdd.php");

    $bdd_quiz = $bdd->query("
        SELECT *, (SELECT COUNT(*) FROM quiz) AS nb_question
        FROM quiz
    ");
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

    <div class="container">
        <div class="jumbotron">
            <h1>Quiz</h1>
            <hr class="my-4">

            <br>

            <form action="quiz_resultat.php" method="POST">
                <?php 
                $numero_question = 0;                           // Numero de la question
                while($row = $bdd_quiz->fetch()) { 
                    $numero_question++;

                    $num_reponse = array('1', '2', '3', '4');   // Numero des réponses,
                    shuffle($num_reponse);                      // La réponse 1 est toujours la bonne réponse, donc on mélange

                    /*
                    Dans la BDD, les réponses sont dans les champs "rep_1", "rep_2", "rep_3", "rep_4".
                    La bonne réponse est toujours dans "rep_1".
                    L'array $num_reponse sert à mélanger les réponses : l'affichage des réponses se fait avec $row["rep_".$num_reponse[0,1,2,3]]
                    */
                ?>

                <!-- QUESTION <?php echo($numero_question); ?> -->
                <div class="card text-center">
                    <div class="card-header">Question <?php echo($numero_question); ?>/<?php echo($row["nb_question"]); ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo($row["question"]); ?></h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponse<?php echo($numero_question); ?>" id="<?php echo($numero_question.$num_reponse[0]) ?>" value="<?php echo($row["rep_".$num_reponse[0]]); ?>" required>
                            <label class="form-check-label" for="<?php echo($numero_question.$num_reponse[0]) ?>"><?php echo($row["rep_".$num_reponse[0]]); ?></label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponse<?php echo($numero_question); ?>" id="<?php echo($numero_question.$num_reponse[1]) ?>" value="<?php echo($row["rep_".$num_reponse[1]]); ?>" required>
                            <label class="form-check-label" for="<?php echo($numero_question.$num_reponse[1]) ?>"><?php echo($row["rep_".$num_reponse[1]]); ?></label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponse<?php echo($numero_question); ?>" id="<?php echo($numero_question.$num_reponse[2]) ?>" value="<?php echo($row["rep_".$num_reponse[2]]); ?>" required>
                            <label class="form-check-label" for="<?php echo($numero_question.$num_reponse[2]) ?>"><?php echo($row["rep_".$num_reponse[2]]); ?></label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponse<?php echo($numero_question); ?>" id="<?php echo($numero_question.$num_reponse[3]) ?>" value="<?php echo($row["rep_".$num_reponse[3]]); ?>" required>
                            <label class="form-check-label" for="<?php echo($numero_question.$num_reponse[3]) ?>"><?php echo($row["rep_".$num_reponse[3]]); ?></label>
                        </div>

                    </div>
                    <div class="card-footer text-muted">&nbsp;</div>
                </div>
                <br>
                <?php } ?>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>