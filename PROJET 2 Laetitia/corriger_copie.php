<!-- PROFESSEUR -->
<html>
 <head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
</head>
<body>

<!--DIV NAV-->
<ul>
  <li><a href="formateur.php">Accueil</a></li>
  <li><a href="creerquizz.php">Créer quiz</a></li>
  <li><a href="modif_quiz_liste.php">Modifier quiz</a></li>
  <li><a class="active" href="corriger_quiz_liste.php">Corriger quiz</a></li>
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

// Récupération de l'id du quiz et de l'utilisateur depuis l'URL
$id_quiz = $_GET['id_quiz'];
$id_user = $_GET['id_user'];

// Récupération des questions du quiz
$query = "SELECT id_question, nom, points FROM question WHERE id_quiz = :id_quiz";
$stmt = $bdd->prepare($query);
$stmt->execute(array(':id_quiz' => $id_quiz));
$questions = $stmt->fetchAll();

// Récupération des réponses de l'élève pour les questions du quiz
$query = "SELECT id_reponse, reponseeleve, annotations, points FROM reponse WHERE id_question = :id_question AND id_user = :id_user";
$stmt = $bdd->prepare($query);

?>

<div id='container'>
<div id='content'>
  <h1>Correction du quiz</h1>

  <form method="post" action="enregistrer_correction.php">
  <?php foreach ($questions as $question) { ?>
  <h3>
    <?php 
    echo $question['nom']; 
    echo " Points Max : " . $question['points'];
    ?>
  </h3>
  <?php
  // Récupération de la valeur de la colonne "points" pour la question en cours
  $query = "SELECT points FROM question WHERE id_question = :id_question";
  $stmtpt = $bdd->prepare($query);
  $stmtpt->execute(array(':id_question' => $question['id_question']));
  $points = $stmtpt->fetchColumn();
  
  $stmt->execute(array(':id_question' => $question['id_question'], ':id_user' => $id_user));
  $reponse = $stmt->fetch();
  ?>
  <p>Réponse de l'élève : 
    <?php 
      if ($reponse) {
        echo "<p>".$reponse['reponseeleve']."</p>";
      } else {
        echo "<p>L'élève n'a pas répondu à cette question.</p>";
      }
    ?>
  </p>
  <label for="annotations_<?php echo $question['id_question']; ?>">Annotation :</label>
  <input type="text" name="annotations_<?php echo $question['id_question']; ?>" id="annotations_<?php echo $question['id_question']; ?>" value="<?php echo str_replace('"', '&quot;', $reponse['annotations']); ?>"><br>
  <label for="points_<?php echo $question['id_question']; ?>">Points :</label>
  <input type="number" name="points_<?php echo $question['id_question']; ?>" id="points_<?php echo $question['id_question']; ?>" value="<?php echo $reponse['points']; ?>" max="<?php echo $points; ?>"><br>
<?php } ?>

    <label for="annotation_globale">Annotation globale :</label>
    <input type="text" name="annotation_globale" id="annotation_globale" value="">    
    <input type="hidden" name="id_quiz" value="<?php echo $id_quiz; ?>">
    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
    <input type="submit" value="Valider">
  </form>
  
</div>
</div>

</body>
</html>
