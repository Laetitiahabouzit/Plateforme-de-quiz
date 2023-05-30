<!-- PROFESSEUR -->
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="listes.css" media="screen" type="text/css" />
</head>
<body>

<!--DIV NAV-->
<ul>
  <li><a href="formateur.php">Accueil</a></li>
  <li><a href="creerquizz.php">Créer quiz</a></li>
  <li><a href="modif_quiz_liste.php">Modifier quiz</a></li>
  <li><a href="corriger_quiz_liste.php">Corriger quiz</a></li>
  <li><a class="active" href="consult_quiz_liste_prof.php">Consulter les copies</a></li>
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

// Récupération de la liste des quiz
$requete_select_quiz = $bdd->query("SELECT * FROM quiz WHERE id_formateur = $iduser");
$quiz = $requete_select_quiz->fetchAll(PDO::FETCH_ASSOC);

echo "<div id='container'>";
echo "<div id='content'>";
echo "<h1>Liste des quiz ayants des copies corigées</h1>";

$quiz_corriges = false;

foreach ($quiz as $q) {
  // Convertir les dates start_time et end_time en timestamps
  $start_time = strtotime($q['start_time']);
  $end_time = strtotime($q['end_time']);

  $requete_resultat = $bdd->prepare("SELECT * FROM resultat WHERE id_quiz = ?");
  $requete_resultat->execute(array($q['id_quiz']));

  if ($requete_resultat->rowCount() > 0) {
    echo "<div id='liste'>";
    echo "<h3><a href='consulter_eleve_liste.php'>" . $q['nom'] . "</a></h3>";
    echo "<p>Date de début : " . $q['start_time'] . "</p>";
    echo "<p>Date de fin : " . $q['end_time'] . "</p>";
    echo "</div>";
    $quiz_corriges = true;

    $_SESSION['id_quiz'] = $q['id_quiz'];
  }
}

if (!$quiz_corriges) {
  echo "<h3 style='color: red'>Vous n'avez pas de copies corrigées.</h3>";
  echo "<p><h3 style='color: red'>Pour pouvoir consulter des copies, il vous faut d'abord en corriger.</h3></p>";
}

echo "</div>";
echo "</div>";

?>

</body>
</html>
