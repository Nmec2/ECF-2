<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | SmartEvent</title>
    <meta name="description" content="Home page, SmartEvent is a website that allows you to create and manage your events.">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/bootstrap.css">
</head>
<body style="background-image: url('./img/bg-index.webp');">
    <header>
        <nav class="navbar p-3 bg-dark">
            <div class="container-fluid">
                <a href="" class="navbar-brand text-light fw-bolder ms-5">SmartEvent</a>
                <div id="button" class="navbar-toggler">
                    <a class="btn btn-outline-light" href="./create.php" role="button">Create Account</a>
                    <a class="btn btn-primary" href="./connexion.php" role="button">Connexion</a>
                </div>  
            </div>
        </nav>

        
    </header>

    <main>     
        <div class="container text-center d-flex justify-content-evenly overflow-hidden" style="height: 80vh;">
            <div class="row align-items-center">
                <div class="col ">
                    <h1 class="display-1 text-light">SmartEvent</h1>
                    <p class="lead text-light">Get started with us check-out our new features.</p>
                    <a href="./create.php" class="btn btn-primary">Create Account</a>
                    <a href="./connexion.php" class="btn btn-outline-light">Connexion</a>
                    <p>
                        <button class="btn text-light mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                            Learn more
                        </button>
                    </p>
                    <div style="min-height: 120px;">
                        <div class="collapse collapse-vertical" id="collapseWidthExample">
                            <div class="card card-body align-items-center" style="width: 600px; background:transparent; border: 1px solid #FFF; backdrop-filter: saturate(150%);">
                                <p class="text-light">SmartEvent is a website that allows you to create and manage your events.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>