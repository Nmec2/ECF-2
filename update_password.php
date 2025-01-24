<?php
session_start();
if(isset($_POST['submit-pass'])){
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    $password = $_POST['pass1'];
    $repassword = $_POST['pass2'];
    $id = $_SESSION['id'];

    $hash = '';

    if (empty($password) || empty($repassword)){
        header('Location: password.php?error=emptyfield');
        exit();
    } else if($password !== $repassword){
        header('Location: password.php?error=passwordmatch');
        exit();
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $req = $bdd->prepare("UPDATE `users` SET `password`= :pass WHERE `id_user` = :id");
        $req->execute(array(':pass' => $hash,
                            ':id' => $id
        ));
        header("Location: password.php?error=success");
    }
} else {
    header("Location: password.php");
}
