<?php
    session_start();

    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();
    $compt = 0;
    $id = $_SESSION['id'];
    if(!$_SESSION['id']){
        header('Location: connexion.php?error=connect');
    } 

    $requ = $bdd->prepare("SELECT `name`, `email` FROM `users` WHERE `id_user` = :id");
    $requ->bindParam(':id', $id, PDO::PARAM_INT);
    $requ->execute();

    $info = $requ->fetch(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/bootstrap.css">
    <link rel="stylesheet" href="./style/style.css">
    <title><?php echo $_SESSION['name']?> | Password change</title>
</head>
<body>
    <main>
        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form action="./update_password.php" method="POST">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'emptyfield'){
                        echo '<p class="text-danger">Veuillez remplir tous les champs!';
                    }else if($_GET['error'] == 'passwordmatch'){
                        echo '<p class="text-danger">Vos mots de passes doivent correspondre!';
                    }else if($_GET['error'] == 'success'){
                        echo '<p class="text-success">Mot de passe modifié avec succès';
                    }

                }
            ?>
            <div class="mb-3">
                <label for="pass1" class="form-label">New password</label>
                <input type="password" class="form-control" id="pass1" name="pass1">
            </div>
            <div class="mb-3">
                <label for="pass2" class="form-label">Re new password</label>
                <input type="password" class="form-control" id="pass2" name="pass2" aria-describedby="emailHelp">
            </div>
            <a class="btn btn-outline-primary mt-3" href="./events.php" role="button">My Event</a>
            <a class="btn btn-outline-primary mt-3" href="./profil.php" role="button">Profil</a>
            <button type="submit" name="submit-pass" class="btn btn-primary mt-3">Updates my password</button>
        </form>
    </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>