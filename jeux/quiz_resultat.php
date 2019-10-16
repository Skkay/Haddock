<?php
	include("../assets/chromephp-master/ChromePhp.php");
	include("../administration/connect_bdd.php");
	$points = 0;

	// Verification des réponses
	$bdd_quiz = $bdd->query("
        SELECT rep_1, (SELECT COUNT(*) FROM quiz) AS nb_question
        FROM quiz
    ");
	$num_question = 0;
	while($row = $bdd_quiz->fetch()) {
		$num_question++;
		if($row["rep_1"] == $_POST["reponse".$num_question]) {
			$points++;
		}
		$score_final = $points."/".$row["nb_question"]; // Message d'affichage du score
	}

?>

<!DOCTYPE html>
<html style="height:643px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    
    <link href="https://fonts.googleapis.com/css?family=Francois+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="quiz_style.css">
</head>

<body>

    <?php include("../include/navbar.php"); ?>

    <p><br></p>

    <div class="container">
        <div class="jumbotron">
            <h3>Résultats du quiz</h3>
            <hr class="my-4">
			<div class="card text-center">
				<div class="card-body">
					<div class="quiz_reponse"><?php echo($score_final); ?></div>
					<?php 
					if($points < 2) {
						echo('<div class="quiz_reponse quiz_label">bonne réponse</div>');
					}
					else {
						echo('<div class="quiz_reponse quiz_label">bonnes réponses</div>');
					}
					?>
					<a href="index.php" class="btn btn-secondary" role="button">Retour aux jeux</a>	
				</div>
			</div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>