<?php
if(isset($_POST['submit'])){
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $hash = '';

    if (empty($name) || empty($email) || empty($password) || empty($repassword)){
        header('Location: create.php?error=emptyfield');
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('Location: create.php?error=invalidmail');
        exit();
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        header('Location: create.php?error=invaliduser');
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $name)){
        header('Location: create.php?error=invaliduser&mail');
        exit();
    } else if($password !== $repassword){
        header('Location: create.php?error=passwordmatch');
        exit();
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        echo $hash;
        $bdd->prepare('');
        //faire l'insertion dans la bdd
    }
}
