<?php
require_once('connexion.php');

// Récupération de l'id du quiz et de l'utilisateur depuis le formulaire
$id_quiz = $_GET['id_quiz'];
$id_user = $_GET['id_user'];

// Récupération des réponses de l'utilisateur pour le quiz en question
$query = $bdd->prepare("SELECT SUM(points) AS points FROM reponse WHERE id_user = :id_user AND id_quiz = :id_quiz");
$query->bindParam(':id_user', $id_user);
$query->bindParam(':id_quiz', $id_quiz);
$query->execute();
$reponse = $query->fetch(PDO::FETCH_ASSOC);

// Calcul de la note
$note = $reponse['points'];

// Enregistrement de la note dans la table "resultat"
$query = $bdd->prepare("UPDATE resultat SET note = :note WHERE id_quiz = :id_quiz AND id_user = :id_user");
$query->bindParam(':id_quiz', $id_quiz);
$query->bindParam(':id_user', $id_user);
$query->bindParam(':note', $note);
$query->execute();

header('Location: corriger_eleve_liste.php?id_quiz='.$id_quiz.'&id_user='.$id_user);
exit();
?>
