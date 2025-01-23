<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/bootstrap.css">
</head>
<body>
    
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form id="form" action="./connexion_secure.php" method="POST">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'emptyfield'){
                        echo '<p class="text-danger">Veuillez remplir tous les champs!';
                    } else if($_GET['error'] == 'invalidmail'){
                        echo '<p class="text-danger">Veuillez remplir une email valide!';
                    } else if($_GET['error'] == 'incorrect'){
                        echo '<p class="text-danger">Mot de passe incorrect!';
                    } else if($_GET['error'] == 'connect'){
                        echo '<p class="text-danger">Veuillez vous connecter!';
                    }
                }
            ?>
            <div class="mb-3">
                <label for="mail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" value="<?php if(isset($_COOKIE['remember_mail'])){echo $_COOKIE['remember_mail'];} ?>">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" id="pass" name="pass" class="form-control" >
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="Check1" name="Check1" <?php if(isset($_COOKIE['remember'])){echo 'checked';} ?>>
                <label class="form-check-label" for="Check1">Remember me</label>
            </div>
            <p>No account ? Create one <a href="create.php">here<a><p>
            <button type="submit" name="submit-co" class="btn btn-primary">Connexion</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>