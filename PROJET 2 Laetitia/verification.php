<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {

    require_once('connexion.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)) {
        $requete = "SELECT role, id_user, id_promo FROM utilisateurs where pseudo = :username and password = :password";
        $stmt = $bdd->prepare($requete);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count!=0) {
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $reponse['id_user'];
            $_SESSION['id_promo'] = $reponse['id_promo'];

            if($reponse['role']=="Formateur") {
                header('Location: formateur.php');
                exit();
            } else if ($reponse['role']=="Eleve") {
                header('Location: eleve.php');
                exit();
            }
        } else {
            header('Location: login.php?erreur=1');
            exit();
        }
    } else {
        header('Location: login.php?erreur=2');
        exit();
    }
}

header('Location: login.php');
exit();
?>