<!-- PROFESSEUR -->
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
    <title>Modifier le quiz</title>
</head>
<body>

<!--DIV NAV-->
<ul>
  <li><a href="formateur.php">Accueil</a></li>
  <li><a href="creerquizz.php">Créer quiz</a></li>
  <li><a class="active" href="modif_quiz_liste.php">Modifier quiz</a></li>
  <li><a href="corriger_quiz_liste.php">Corriger quiz</a></li>
  <li><a href="consult_quiz_liste_prof.php">Consulter les copies</a></li>
</ul>

<?php
 session_start();

 if(isset($_SESSION['username']) && isset($_SESSION['id_user'])) {

 $user = $_SESSION['username'];
 $iduser = $_SESSION['id_user'];

 // afficher un message
 echo "<header><h3>$user</h3>";
 echo "<div>Bienvenue sur votre espace formateur !</div>";
 echo "</header>";

}

require_once('connexion.php');

// Vérifie que l'ID du quiz à modifier est passé en GET
if (isset($_GET['id_quiz'])) {
    // Récupère l'ID du quiz à modifier
    $id_quiz = $_GET['id_quiz'];

    // Récupère les données du quiz à modifier
    $requete_select_quiz = $bdd->prepare("SELECT * FROM quiz WHERE id_quiz = :id_quiz");
    $requete_select_quiz->bindParam(':id_quiz', $id_quiz);
    $requete_select_quiz->execute();
    $quiz = $requete_select_quiz->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire a été soumis, met à jour les valeurs dans la base de données
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];
        $promo = $_POST['promo'];

        $requete_update_quiz = $bdd->prepare("UPDATE quiz SET id_promo = :id_promo, nom = :nom, start_time = :debut, end_time = :fin WHERE id_quiz = :id_quiz");
        $requete_update_quiz->bindParam(':id_quiz', $id_quiz);
        $requete_update_quiz->bindParam(':id_promo', $promo);
        $requete_update_quiz->bindParam(':nom', $nom);
        $requete_update_quiz->bindParam(':debut', $debut);
        $requete_update_quiz->bindParam(':fin', $fin);
        $requete_update_quiz->execute();

        // Met à jour les questions associées au quiz
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $id_question = substr($key, strlen('question_'));
                $nom_question = str_replace("'", "&apos;", $_POST['question_' . $id_question]);
                $points_question = $_POST['points_' . $id_question];

                $requete_update_question = $bdd->prepare("UPDATE question SET nom = :nom, points = :points WHERE id_question = :id_question");
                $requete_update_question->bindParam(':id_question', $id_question);
                $requete_update_question->bindParam(':nom', $nom_question);
                $requete_update_question->bindParam(':points', $points_question);
                $requete_update_question->execute();
            }
        }

        // Redirige l'utilisateur vers la liste des quiz
        header('Location: modif_quiz_liste.php');
        exit;
    }
} else {
    echo "L'id du quiz n'a pas été passé en GET";
    exit;
}

?>

<div id="container">
<div id="content">    
    <h1>Modifier le quiz</h1>
    <form method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo $quiz['nom']; ?>"><br><br>
        <label for="debut">Date de début :</label>
        <input type="datetime-local" name="debut" id="debut" value="<?php echo date('Y-m-d\TH:i', strtotime($quiz['start_time'])); ?>"><br><br>
        <label for="fin">Date de fin :</label>
        <input type="datetime-local" name="fin" id="fin" value="<?php echo date('Y-m-d\TH:i', strtotime($quiz['end_time'])); ?>"><br><br>
        <label for="promo">Promotion : </label>
        <select name="promo">
        <?php
            $requete_promo = $bdd->query("SELECT id_promo, nom_promo FROM promotion");
            while($donnees_promo = $requete_promo->fetch()){
                echo "<option value='".$donnees_promo['id_promo']."'>".$donnees_promo['nom_promo']."</option>";
            }
        ?>
        </select>

        <!-- Section pour modifier les questions -->
        <h2>Modifier les questions</h2>
        <?php
            // Récupère les questions associées au quiz
            $requete_select_questions = $bdd->prepare("SELECT * FROM question WHERE id_quiz = :id_quiz");
            $requete_select_questions->bindParam(':id_quiz', $id_quiz);
            $requete_select_questions->execute();
            $questions = $requete_select_questions->fetchAll(PDO::FETCH_ASSOC);
            
            // Affiche chaque question dans un formulaire de modification
            foreach ($questions as $question) {
                echo "<input type='hidden' name='id_question' value='".$question['id_question']."'>";
                echo "<label for='question_".$question['id_question']."'>Question :</label>";
                echo "<input type='text' name='question_".$question['id_question']."' id='question_".$question['id_question']."' value='".$question['nom']."'><br>";
                echo "<label for='points_".$question['id_question']."'>Points :</label>";
                echo "<input type='number' name='points_".$question['id_question']."' id='points_".$question['id_question']."' value='".$question['points']."'><br>";
            }
        ?>

        <input type="submit" name="submit" value="Enregistrer">
    </form>
</div>
</div>
</body>
</html>