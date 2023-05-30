<!-- PROFESSEUR -->
<html>
 <head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //fonction pour ajouter une ligne
        $(".quest").click(function() {
            var nomquest = "<input type='text' name='text[]' required>";
            var points = "<input type='number' name='points[]' required>";
            var ligne = "<tr><td><input type='checkbox' name='select[]'></td><td>" + nomquest + "</td><td>" + points + "</td></tr>";
            $("table.test").append(ligne);
        });

        //fonction pour supprimer les lignes cochés
        $(".delete").click(function() {
            $("table.test").find('input[name="select[]"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("table.test tr").remove();
                }
            });
        });
    });  
</script>
</head>
<body>

<!--DIV NAV-->
<ul>
  <li><a href="formateur.php">Accueil</a></li>
  <li><a class="active" href="creerquizz.php">Créer quiz</a></li>
  <li><a href="modif_quiz_liste.php">Modifier quiz</a></li>
  <li><a href="corriger_quiz_liste.php">Corriger quiz</a></li>
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
 
    if(isset($_POST['quizzname']) && isset($_POST['debut']) && isset($_POST['fin'])){

        //Récupération des données du formulaire
        $nom = $_POST['quizzname'];
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];
        $promo = $_POST['promo'];
    
        //Insertion des données dans la table "quiz"
        $requete_insert_quiz = $bdd->prepare("INSERT INTO quiz(id_promo, nom, id_formateur, start_time, end_time) VALUES(:id_promo, :nom, :iduser, :debut, :fin)");
        $requete_insert_quiz->bindParam(':id_promo', $promo); 
        $requete_insert_quiz->bindParam(':nom', $nom);
        $requete_insert_quiz->bindParam(':iduser', $iduser);       
        $requete_insert_quiz->bindParam(':debut', $debut);
        $requete_insert_quiz->bindParam(':fin', $fin);
        $requete_insert_quiz->execute();

        // echo $requete_insert_quiz->queryString;
    
        //Récupération de l'id du dernier quiz créé
        $id_quiz = $bdd->lastInsertId();
    
        //Insertion des données des questions dans la table "question"
        if(isset($_POST['text']) && isset($_POST['points'])){
            $questions = str_replace("'", "''", $_POST['text']);
            $points = $_POST['points'];
    
            for($i=0; $i<count($questions); $i++){
                $requete_insert_question = $bdd->prepare("INSERT INTO question(id_quiz, nom, points) VALUES(:id_quiz, :nom, :points)");
                $requete_insert_question->bindParam(':id_quiz', $id_quiz);
                $requete_insert_question->bindParam(':nom', $questions[$i]);
                $requete_insert_question->bindParam(':points', $points[$i]);
                $requete_insert_question->execute();
            }
        }
        echo "<script>alert(\"Votre quiz a bien été créé !\")</script>";
    }
?>

<div id="container">
<div id='content'>

    <h1>Créer un nouveau quiz</h1>

    <form action="" method="POST">        
        <label><b>Nom du quizz</b></label>
        <input type="text" placeholder="Nom du quizz" name="quizzname" required>

        <div>
            <label for="appt">Début : </label>
            <input type="datetime-local" name="debut" required>

            <label for="appt">Fin : </label>
            <input type="datetime-local" name="fin" required>

            <label for="promo">Promotion : </label>
            <select name="promo">
            <?php
                $requete_promo = $bdd->query("SELECT id_promo, nom_promo FROM promotion");
                while($donnees_promo = $requete_promo->fetch()){
                    echo "<option value='".$donnees_promo['id_promo']."'>".$donnees_promo['nom_promo']."</option>";
                }
            ?>
            </select>
        </div>

        <!-- CREATION DES QUESTIONS -->
        <div>
            <input type="hidden" name="id_quizz" value="<?php echo 2 ?>">
            <table class="test">
                    <tr>
                        <th colspan="1">Select</th>
                        <th colspan="1">Question</th>
                        <th colspan="1">Points</th>
                    </tr>
            </table>
            <input type="button" class="quest" value="Ajouter question">
            <input type="button" class="delete" value="Supprimer une question">
            <input type="submit" id='submit' value='VALIDER' >
        </div>
    </form>
</div>
</div>

</body>
</html>