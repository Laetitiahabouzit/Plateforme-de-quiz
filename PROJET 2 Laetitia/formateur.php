<!-- PROFESSEUR -->
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
</head>
<body>

<!--DIV NAV-->
<ul>
  <li><a class="active" href="formateur.php">Accueil</a></li>
  <li><a href="creerquizz.php">Créer quiz</a></li>
  <li><a href="modif_quiz_liste.php">Modifier quiz</a></li>
  <li><a href="corriger_quiz_liste.php">Corriger quiz</a></li>
  <li><a href="consult_quiz_liste_prof.php">Consulter les copies</a></li>
</ul>

<!-- tester si l'utilisateur est connecté -->
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

// Récupération de toutes les valeurs start_time et end_time pour les quiz du formateur
$requete_times = $bdd->query("SELECT id_quiz, start_time, end_time FROM quiz WHERE id_formateur = $iduser");

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

// Récupération de la liste des quiz
$requete_quiz = $bdd->query("SELECT * FROM quiz WHERE id_formateur = $iduser");

// Affichage de la liste des quiz
echo "<div id='container'>";
echo "<div id='content'>";
echo "<h1>Liste de tous les quiz que vous avez créé</h1>";
while ($quiz = $requete_quiz->fetch()) {
    echo "<div id='liste'>";

    // Vérification des conditions pour déterminer le lien à afficher
    $current_time = time();
    $start_time = strtotime($times_array[$quiz['id_quiz']]['start_time']);
    $end_time = strtotime($times_array[$quiz['id_quiz']]['end_time']);

    if ($current_time < $start_time) {
        echo "<h3><a href='modifquiz.php?id_quiz=".$quiz['id_quiz']."'>".$quiz['nom']."</a> (à venir) </h3>";
    } else if ($current_time >= $start_time && $current_time <= $end_time) {
        echo "<h3><a href='javascript:void(0)' onclick=\"alert('Vous ne pouvez ni modifier ni corriger ce quiz car il est en cours et les élèves ont déjà commencé à répondre !')\">".$quiz['nom']."</a> <font color='red'>(en cours)</font> </h3>";
    } else {
        echo "<h3><a href='corriger_eleve_liste.php?id_quiz=".$quiz['id_quiz']."'>".$quiz['nom']."</a> <font color='green'>(terminé)</font> </h3>";
    }

    // Affichage des valeurs start_time et end_time pour ce quiz
    if (isset($times_array[$quiz['id_quiz']])) {
        echo "<p>Date de début : ".$times_array[$quiz['id_quiz']]['start_time'] . "</p>";
        echo "<p>Date de fin : ".$times_array[$quiz['id_quiz']]['end_time'] . "</p>";
    }
    echo "</div>";
}

echo "</div>";
echo "</div>";

// Fermeture de la requête
$requete_quiz->closeCursor();

 ?>

 </body>
</html>