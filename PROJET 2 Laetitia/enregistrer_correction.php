<?php
require_once('connexion.php');

// Récupération de l'id du quiz et de l'utilisateur depuis le formulaire
$id_quiz            = $_POST['id_quiz'];
$id_user            = $_POST['id_user'];
$annotation_globale = $_POST['annotation_globale'];

// Parcours des questions et enregistrement des réponses de l'élève
foreach ($_POST as $name => $value) {
    if (strpos($name, 'annotations_') === 0) {
        $id_question = substr($name, strlen('annotations_'));
        $points = $_POST['points_'.$id_question];

        // Vérifie si une entrée existe déjà pour cette question et cet utilisateur
        $query = "SELECT COUNT(*) FROM reponse WHERE id_quiz = :id_quiz AND id_user = :id_user AND id_question = :id_question";
        $stmt_select = $bdd->prepare($query);
        $stmt_select->execute(array(':id_quiz' => $id_quiz, ':id_user' => $id_user, ':id_question' => $id_question));
        $count = $stmt_select->fetchColumn();        
        
        // Si l'entrée n'existe pas, insère une nouvelle entrée dans la table reponse
        if ($count <= 0) {
            $reponseeleve = '';
            $query = "INSERT INTO reponse (id_quiz, id_question, id_user, reponseeleve, annotations, points) VALUES (:id_quiz, :id_question, :id_user, :reponseeleve, :annotations, :points)";
            $stmt_insert = $bdd->prepare($query);
            $stmt_insert->execute(array(':id_quiz' => $id_quiz, ':id_question' => $id_question, ':id_user' => $id_user, ':reponseeleve' => $reponseeleve, ':annotations' => $value, ':points' => $points));            
        } 
        // Sinon, met à jour l'entrée existante
        else {
            $query = "UPDATE reponse SET annotations = :annotations, points = :points WHERE id_question = :id_question AND id_user = :id_user";
            $stmt = $bdd->prepare($query);
            $stmt->execute(array(':annotations' => $value, ':points' => $points, ':id_question' => $id_question, ':id_user' => $id_user));
        }
    }

    // Vérifie si une entrée existe déjà pour cette annotations globale et cet utilisateur
    $query2 = "SELECT COUNT(*) FROM resultat WHERE id_quiz = :id_quiz AND id_user = :id_user";
    $stmt_select2 = $bdd->prepare($query2);
    $stmt_select2->execute(array(':id_quiz' => $id_quiz, ':id_user' => $id_user));
    $count2 = $stmt_select2->fetchColumn();

    // Si l'entrée n'existe pas, insère une nouvelle entrée dans la table resultat
    if ($count2 <= 0) {
    $note = NULL;
    $query2 = "INSERT INTO resultat (id_quiz, id_user, annotation_globale, note) VALUES (:id_quiz, :id_user, :annotation_globale, :note)";
    $stmt_insert2 = $bdd->prepare($query2);
    $stmt_insert2->execute(array(':id_quiz' => $id_quiz, ':id_user' => $id_user, ':annotation_globale' => $annotation_globale, ':note' => $note));
    }
    // Sinon, met à jour l'entrée existante
    else {
    $query2 = "UPDATE resultat SET annotation_globale = :annotation_globale WHERE id_quiz = :id_quiz AND id_user = :id_user";
    $stmt2 = $bdd->prepare($query2);
    $stmt2->execute(array(':annotation_globale' => $annotation_globale, ':id_quiz' => $id_quiz, ':id_user' => $id_user));
    }
}

// Redirection vers la page de visualisation du quiz
// echo "id_user : $id_user<br>";
// echo "id_quiz : $id_quiz<br>";
// echo "id_question : $id_question<br>";
// echo "annotation : $value<br>";
// echo "points : $points<br>";
// echo "Nombre d'entrées trouvées : $count<br>";
// echo "Nombre d'entrées trouvées : $count2<br>";
// echo "annotation_globale : $annotation_globale<br>";
// echo "Note : $note<br>";
// echo "$query<br>";
// echo $query2;

header('Location: calcul_note.php?id_quiz='.$id_quiz.'&id_user='.$id_user);
exit();
?>
