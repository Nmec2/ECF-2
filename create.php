<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/bootstrap.css">
</head>
<body>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form id="form" action="./validate_create.php" method="POST">
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
                    } else if($_GET['error'] == 'passwordmatch'){
                        echo '<p class="text-danger">Vos mots de passes doivent correspondre!';
                    } else if($_GET['error'] == 'success'){
                        echo '<p class="text-success">Comptes crée avec succès';
                    } else if($_GET['error'] == 'alreadymail'){
                        echo '<p class="text-danger">E-mail déjà utiliser!';
                    }

                }
            ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="repassword" class="form-label">Re password</label>
                <input type="password" class="form-control" id="repassword" name="repassword">
            </div>
            <p>Got an account ? <a href="connexion.php"> We got you <a></p>
            <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
</body>
</html>