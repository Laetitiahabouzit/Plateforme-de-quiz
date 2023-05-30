<!-- ELEVE -->
<html>
<head>
    <meta charset="utf-8">
    <title>Répondre au quiz</title>
    <link rel="stylesheet" href="listes.css" media="screen" type="text/css" />
</head>
<body>

 <!--DIV NAV-->
 <ul>
  <li><a href="eleve.php">Accueil</a></li>
  <li><a class="active" href="repondre_quiz_liste.php">Quiz disponibles</a></li>
  <li><a href="consult_quiz_liste.php">Résultats</a></li>
</ul>

<?php
 session_start();

 if($_SESSION['id_promo'] !== ""){
  $idpromo = $_SESSION['id_promo'];
  }

 if(isset($_SESSION['username']) && isset($_SESSION['id_user'])) {

 $user = $_SESSION['username'];
 $id_user = $_SESSION['id_user'];

 // afficher un message
 echo "<header><h3>$user</h3>";

 if ($idpromo == 1){
  echo "<div>Bienvenue sur votre espace élève ! Filière Scientifique</div>";
} else if ($idpromo == 2){
  echo "<div>Bienvenue sur votre espace élève ! Filière Littéraire</div>";
} else {
  echo "<div>Bienvenue sur votre espace élève ! Filière Economique</div>";    
}

 echo "</header>";
}

require_once('connexion.php');

// Récupération de l'id du quiz depuis l'URL
$id_quiz = $_GET['id_quiz'];

// Récupération des questions pour le quiz correspondant
$requete_select_questions = $bdd->prepare("SELECT * FROM question WHERE id_quiz = :id_quiz");
$requete_select_questions->bindParam(':id_quiz', $id_quiz);
$requete_select_questions->execute();
$questions = $requete_select_questions->fetchAll(PDO::FETCH_ASSOC);

echo "<div id='container'>";
echo "<div id='content'>";

// Affichage des questions avec des champs pour répondre
echo "<form method='post' action=''>";
foreach ($questions as $q) {
    echo "<h2>" . $q['nom'] . "</h2>";
    echo "<p>Nombre de points : " . $q['points'] . "</p>";
    echo "<input type='text' name='reponse_q" . $q['id_question'] . "' placeholder='Réponse à la question'>";
    echo "<input type='hidden' name='id_question_q" . $q['id_question'] . "' value='" . $q['id_question'] . "'>";
}
echo "<input type='submit' name='valider' value='Valider'>";
echo "<input type='hidden' name='id_user' value='" . $id_user . "'>";
echo "<input type='hidden' name='id_quiz' value='" . $id_quiz . "'>";
echo "</form>";

// Enregistrement des réponses de l'utilisateur dans la table "reponse"
if(isset($_POST['valider'])) {
    foreach ($questions as $q) {
        $id_question = $q['id_question'];
        $reponse_eleve = $_POST['reponse_q' . $id_question];
        // Vérification si une ligne existe déjà pour l'utilisateur et le quiz en question
        $requete_select_reponse = $bdd->prepare("SELECT * FROM reponse WHERE id_quiz = :id_quiz AND id_question = :id_question AND id_user = :id_user");
        $requete_select_reponse->bindParam(':id_quiz', $id_quiz);
        $requete_select_reponse->bindParam(':id_question', $id_question);
        $requete_select_reponse->bindParam(':id_user', $id_user);
        $requete_select_reponse->execute();
        $resultat = $requete_select_reponse->fetch(PDO::FETCH_ASSOC);

        if($resultat) {
            // Si une ligne existe déjà, on met à jour les informations existantes
            $requete_update_reponse = $bdd->prepare("UPDATE reponse SET reponseeleve = :reponse_eleve WHERE id_quiz = :id_quiz AND id_question = :id_question AND id_user = :id_user");
            $requete_update_reponse->bindParam(':reponse_eleve', $reponse_eleve);
            $requete_update_reponse->bindParam(':id_quiz', $id_quiz);
            $requete_update_reponse->bindParam(':id_question', $id_question);
            $requete_update_reponse->bindParam(':id_user', $id_user);
            $requete_update_reponse->execute();
        } else {
            // Sinon, on insère une nouvelle ligne
            $requete_insert_reponse = $bdd->prepare("INSERT INTO reponse (id_quiz, id_question, id_user, reponseeleve, annotations, points) VALUES (:id_quiz, :id_question, :id_user, :reponse_eleve, '', '0')");
            $requete_insert_reponse->bindParam(':id_quiz', $id_quiz);
            $requete_insert_reponse->bindParam(':id_question', $id_question);
            $requete_insert_reponse->bindParam(':id_user', $id_user);
            $requete_insert_reponse->bindParam(':reponse_eleve', $reponse_eleve);
            $requete_insert_reponse->execute();
        }
    }

    $_SESSION['msg_validation_reponse'] = "Vos réponses ont bien été validées !";
    header('Location: eleve.php');
    exit;

}

echo "</div>";
echo "</div>";
?>

    </body>
</html>    