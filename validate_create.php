<?php
if(isset($_POST['submit'])){
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    
    $verif = $bdd ->prepare("SELECT COUNT(*) FROM `users` WHERE email = :email");
    $verif->bindParam(':email', $email, PDO::PARAM_STR);
    $verif->execute();
    $count = $verif->fetchColumn();

    $hash = '';

    if (empty($name) || empty($email) || empty($password) || empty($repassword)){
        header('Location: create.php?error=emptyfield');
        exit();
    } else if($count > 0){
        header('Location: create.php?error=alreadymail');
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
        $req = $bdd->prepare("INSERT INTO `users`(`name`, `email`, `password`, `user_date_creation`) VALUES (:name, :email, :password,NOW())");
        $req->execute(array(':name' => $name,
                            ':email' => $email,
                            ':password' => $hash
        ));
        header("Location: create.php?error=success");
    }
} else {
    header("Location: create.php");
}
