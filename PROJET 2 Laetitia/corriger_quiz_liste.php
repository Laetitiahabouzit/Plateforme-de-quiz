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

// Récupération de la liste des quiz
$requete_quiz = $bdd->query("SELECT * FROM quiz WHERE id_formateur = $iduser");

// Affichage de la liste des quiz
echo "<div id='container'>";
echo "<div id='content'>";
echo "<h1>Liste des quiz corrigeables</h1>";

while ($quiz = $requete_quiz->fetch()) {
    // Convertir les dates start_time et end_time en timestamps
    $start_time = strtotime($quiz['start_time']);
    $end_time = strtotime($quiz['end_time']);
 
    if (time() > $end_time) {
    echo "<div id='liste'>";
    echo "<h3><a href='corriger_eleve_liste.php?id_quiz=".$quiz['id_quiz']."'>".$quiz['nom']."</a></h3>";
    echo "<p>Date de début : " . $quiz['start_time'] . "</p>";
    echo "<p>Date de fin : " . $quiz['end_time'] . "</p>";
    echo "</div>";
    }
}
echo "</div>";
echo "</div>";

// Fermeture de la requête
$requete_quiz->closeCursor();

?>

</body>
</html>