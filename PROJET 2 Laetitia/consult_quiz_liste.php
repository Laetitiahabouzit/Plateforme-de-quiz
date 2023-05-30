<!-- ELEVE -->
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="listes.css" media="screen" type="text/css" />
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
$iduser = $_SESSION['id_user'];

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

// Récupération des quiz dans la base de données
$requete_select_quiz = $bdd->query("SELECT * FROM quiz WHERE id_promo = $idpromo");
$quiz = $requete_select_quiz->fetchAll(PDO::FETCH_ASSOC);

echo "<div id='container'>";
echo "<div id='content'>";
echo "<h1>Liste des quiz corrigés</h1>";

// Affichage des quiz avec des liens vers la page pour répondre au quiz
foreach ($quiz as $q) {
  // Convertir les dates start_time et end_time en timestamps
  $start_time = strtotime($q['start_time']);
  $end_time = strtotime($q['end_time']);

  // Vérifier si l'heure actuelle est entre start_time et end_time
  if (time() >= $end_time) {
    // Vérifier si le professeur a corrigé
    $requete_resultat = $bdd->prepare("SELECT * FROM resultat WHERE id_quiz = ? AND id_user = ?");
    $requete_resultat->execute(array($q['id_quiz'], $_SESSION['id_user']));

    // Si la copie n'a pas encore été corrigée
    if ($requete_resultat->rowCount() <= 0) {
      echo "<div id='liste'>";
      echo "<h3><a href='javascript:void(0)' onclick=\"alert('Votre copie n\\'a pas encore été corrigée.')\">" . $q['nom'] . "</a></h3>";
      echo "<p>Date de début : " . $q['start_time'] . "</p>";
      echo "<p>Date de fin : " . $q['end_time'] . "</p>";
      echo "</div>";
    } else {
      // Si la copie a été corrigée
      echo "<div id='liste'>";
      echo "<h3><a href='consultcopie.php?id_quiz=" . $q['id_quiz'] . "&id_user=" . $_SESSION['id_user'] . "'>" . $q['nom'] . "</a></h3>";
      echo "<p>Date de début : " . $q['start_time'] . "</p>";
      echo "<p>Date de fin : " . $q['end_time'] . "</p>";
      echo "</div>";
    }
  }
}
echo "</div>";
echo "</div>";

?>

</body>
</html>
