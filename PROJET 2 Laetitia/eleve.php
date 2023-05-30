<!-- ELEVE -->
<html>
 <head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
 </head>
 <body>
 <div id="content">

 <!--DIV NAV-->
<ul>
  <li><a class="active" href="eleve.php">Accueil</a></li>
  <li><a href="repondre_quiz_liste.php">Quiz disponibles</a></li>
  <li><a href="consult_quiz_liste.php">Résultats</a></li>
</ul>

<?php
 session_start();

// Afficher le message de validation s'il existe
if(isset($_SESSION['msg_validation_reponse'])) {
  echo "<script>alert(\"".$_SESSION['msg_validation_reponse']."\")</script>";
  unset($_SESSION['msg_validation_reponse']);
}

 if($_SESSION['id_promo'] !== ""){
  $idpromo = $_SESSION['id_promo'];
  }

 if(isset($_SESSION['username']) && isset($_SESSION['id_user'])) {

 $user = $_SESSION['username'];
 $iduser = $_SESSION['id_user'];

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

// Récupération de toutes les valeurs start_time et end_time pour les quiz du formateur
$requete_times = $bdd->query("SELECT id_quiz, start_time, end_time FROM quiz WHERE id_promo = $idpromo");

// Stockage des valeurs dans un tableau associatif
$times_array = array();
while ($times = $requete_times->fetch()) {
    $times_array[$times['id_quiz']] = array(
        'start_time' => $times['start_time'],
        'end_time' => $times['end_time']
    );
}

// Fermeture de la requête
$requete_times->closeCursor();

// Récupération des quiz dans la base de données
$requete_quiz = $bdd->query("SELECT * FROM quiz WHERE id_promo = $idpromo");

echo "<div id='container'>";
echo "<div id='content'>";
echo "<h1>Liste de tous les quiz affectés à votre fillière</h1>";

// Affichage des quiz avec des liens vers la page pour répondre au quiz
while ($quiz = $requete_quiz->fetch()) {
  echo "<div id='liste'>";

  // Vérification des conditions pour déterminer le lien à afficher
  $current_time = time();
  $start_time = strtotime($times_array[$quiz['id_quiz']]['start_time']);
  $end_time = strtotime($times_array[$quiz['id_quiz']]['end_time']);

  if ($current_time < $start_time) {
    echo "<h3><a href='javascript:void(0)' onclick=\"alert('Ce quiz est indisponible pour le moment')\">".$quiz['nom']."</a> <font color='red'>(à venir)</font> </h3>";
  } else if ($current_time >= $start_time && $current_time <= $end_time) {
    echo "<h3><a href='repondre_quiz.php?id_quiz=".$quiz['id_quiz']."'>".$quiz['nom']."</a> (en cours) </h3>";
  } else {
    $requete_resultat = $bdd->prepare("SELECT * FROM resultat WHERE id_quiz = ? AND id_user = ?");
    $requete_resultat->execute(array($q['id_quiz'], $_SESSION['id_user']));
    
    if ($requete_resultat->rowCount() <= 0) {
        echo "<h3><a href='javascript:void(0)' onclick=\"alert('Votre copie n\\'a pas encore été corrigée.')\">" . $quiz['nom'] . "</a> (terminé) </h3>";
    } else {      
        echo "<h3><a href='consultcopie.php?id_quiz=".$quiz['id_quiz']."'>".$quiz['nom']."</a> (terminé) </h3>";
    }
  }

  // Affichage des valeurs start_time et end_time pour ce quiz
  if (isset($times_array[$quiz['id_quiz']])) {
      echo "<p>Date de début : ".$times_array[$quiz['id_quiz']]['start_time'] . "</p>";
      echo "<p>Date de Fin : ".$times_array[$quiz['id_quiz']]['end_time'] . "</p>";
  }
  echo "</div>";
}

echo "</div>";
echo "</div>";

?>

 </div>
 </body>
</html>
