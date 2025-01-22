<?php

if(isset($_POST['submit-co']) && $_POST['pass'] != '' && $_POST['mail'] != ''){
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    
    $requ = $bdd->prepare('SELECT `id_user`, `name`, `email`, `password`, DATE_FORMAT(user_date_creation, "%d/%m/%Y à %H:%i:%s") as DATE_AFF FROM `users` WHERE `email` = :mail');
    $requ->bindParam(':mail', $mail, PDO::PARAM_STR);
    $requ->execute();
    $test = $requ->fetch(PDO::FETCH_ASSOC);

    if(isset($test['password'])){
        if(password_verify($pass, $test['password'])){
            session_start();
            $_SESSION['id'] = $test['id_user']; 
            $_SESSION['name'] = $test['name']; 
            $_SESSION['email'] = $test['email'];
            $_SESSION['date_user'] = $test['DATE_AFF']; 
            $_SESSION['connecter'] = 'true';
            header('Location: events.php');
        } else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            header('Location: connexion.php?error=invalidmail');
            exit();
        } else {
            header("Location: connexion.php?error=incorrect");
        }
    }

} else {
    header("Location: connexion.php?error=emptyfield");
}

