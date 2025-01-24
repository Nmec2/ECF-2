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
    <title><?php echo $_SESSION['name']?> | Profile</title>
</head>
<body>
    <main>
        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form action="./update_profil.php" method="POST">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'emptyfield'){
                        echo '<p class="text-danger">Veuillez remplir tous les champs!';
                    } else if($_GET['error'] == 'invalidmail'){
                        echo '<p class="text-danger">Veuillez remplir une email valide!';
                    } else if($_GET['error'] == 'invaliduser'){
                        echo '<p class="text-danger">Votre name doit contenir uniquement des lettres et des chiffres!';
                    } else if($_GET['error'] == 'invaliduser&mail'){
                        echo '<p class="text-danger">Votre name doit contenir uniquement des lettres et des chiffres! et votre email doit être valide!';
                    } else if($_GET['error'] == 'success'){
                        echo '<p class="text-success">Profil modifié avec succès';
                    }

                }
            ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $info['name']?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $info['email']?>">
            </div>
            <a class="btn btn-outline-primary mt-3" href="./events.php" role="button">My Event</a>
            <a class="btn btn-outline-primary mt-3" href="./password.php" role="button">Change password</a>
            <button type="submit" name="submit-updates" class="btn btn-primary mt-3">Updates my profil</button>
        </form>
    </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>