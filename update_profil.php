<?php
session_start();
if(isset($_POST['submit-updates'])){
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $id_user = $_SESSION['id'];
    

    if (empty($name) || empty($email)){
        header('Location: profil.php?error=emptyfield');
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('Location: profil.php?error=invalidmail');
        exit();
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        header('Location: profil.php?error=invaliduser');
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $name)){
        header('Location: profil.php?error=invaliduser&mail');
        exit();
    } else {
        $req = $bdd->prepare("UPDATE `users` SET `name`= :name,`email`= :email WHERE `id_user` = :id");
        $req->execute(array(':name' => $name,
                            ':email' => $email,
                            ':id' => $id_user
        ));
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header("Location: profil.php?error=success");
    }
} else {
    header("Location: profil.php");
}
