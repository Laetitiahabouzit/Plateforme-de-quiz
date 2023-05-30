<!-- ELEVE -->
<html>
 <head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
</head>
<body>
<!--DIV NAV-->
<ul>
  <li><a href="eleve.php">Accueil</a></li>
  <li><a href="repondre_quiz_liste.php">Quiz disponibles</a></li>
  <li><a class="active" href="consult_quiz_liste.php">Résultats</a></li>
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

  // Récupération de l'id du quiz et de l'utilisateur depuis l'URL
  $id_quiz = $_GET['id_quiz'];

  // Récupération du nom du quiz
  $query = "SELECT nom FROM quiz WHERE id_quiz = :id_quiz";
  $stmt = $bdd->prepare($query);
  $stmt->execute(array(':id_quiz' => $id_quiz));
  $nom_quiz = $stmt->fetch()['nom'];

  // Récupération des questions du quiz
  $query = "SELECT id_question, nom, points FROM question WHERE id_quiz = :id_quiz";
  $stmt = $bdd->prepare($query);
  $stmt->execute(array(':id_quiz' => $id_quiz));
  $questions = $stmt->fetchAll();

  // Récupération des réponses de l'élève pour les questions du quiz
  $query = "SELECT id_reponse, reponseeleve, annotations, points FROM reponse WHERE id_question = :id_question AND id_user = :id_user";
  $stmt = $bdd->prepare($query);

  // Calcul de la moyenne des notes pour le quiz
  $query = "SELECT AVG(note) AS moyenne FROM resultat WHERE id_quiz = :id_quiz";
  $stmt2 = $bdd->prepare($query);
  $stmt2->execute(array(':id_quiz' => $id_quiz));
  $moyenne_quiz = $stmt2->fetch()['moyenne'];

  ?>

<div id='container'>
  <h2>Nom du quiz : <?php echo $nom_quiz; ?></h2>
  <table>
    <thead>
      <tr>
        <th>Question</th>
        <th>Réponse de l'élève</th>
        <th>Annotation</th>
        <th>Points</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($questions as $question) { ?>
        <tr>
          <td><?php echo $question['nom']; ?></td>
          <?php
            $stmt->execute(array(':id_question' => $question['id_question'], ':id_user' => $id_user));
            $reponse = $stmt->fetch();
          ?>
          <td><?php echo $reponse['reponseeleve']; ?></td>
          <td><?php echo $reponse['annotations']; ?></td>
          <td><?php echo $reponse['points']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <p>Moyenne du quiz :</p>
  <?php echo "$moyenne_quiz <br/>"; ?>

  <?php
// Récupération de la note de l'élève pour le quiz actuel
$query = "SELECT note FROM resultat WHERE id_quiz = :id_quiz AND id_user = :id_user";
$stmt = $bdd->prepare($query);
$stmt->execute(array(':id_quiz' => $id_quiz, ':id_user' => $id_user));
$note_eleve = $stmt->fetch()['note'];

// Récupération du classement des élèves pour le quiz actuel
$query = "SELECT id_user, note FROM resultat WHERE id_quiz = :id_quiz ORDER BY note DESC";
$stmt = $bdd->prepare($query);
$stmt->execute(array(':id_quiz' => $id_quiz));
$classement = $stmt->fetchAll();

// Recherche de la position de l'élève dans le classement
$position = 0;
foreach ($classement as $rang) {
    $position++;
    if ($rang['id_user'] == $id_user) {
        break;
    }
}

// Récupération du nombre total d'élèves ayant passé le quiz
$query = "SELECT COUNT(DISTINCT id_user) AS total FROM resultat WHERE id_quiz = :id_quiz";
$stmt = $bdd->prepare($query);
$stmt->execute(array(':id_quiz' => $id_quiz));
$total_eleves = $stmt->fetch()['total'];

// Affichage de la position de l'élève dans le classement
echo "Note : " . $note_eleve . "<br/>";
echo "Position dans le classement : " . $position . " sur " . $total_eleves;

?>

</div>

</body>
</html>