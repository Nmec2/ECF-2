<?php
    session_start();

    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();
    $compt = 0;
    if(!$_SESSION['id']){
        header('Location: connexion.php?error=connect');
    } 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/bootstrap.css">
    <link rel="stylesheet" href="./style/style.css">
    <title><?php echo $_SESSION['name'];?> | Event</title>
</head>
<body>
<!-- Button trigger modal -->
    <header>
        <div id="sidebar" class="sm-5 bg-dark">
            <p class="fs-3 text-light fw-bolder text-center pt-3">SmartEvent</a>
            <p class="fs-5 text-danger text-center pt-3"><?php echo 'Bienvenue '. $_SESSION['name']?></a>
            <p class="fs-6 text-light text-center pt-1"><?php echo 'Membre depuis le '. $_SESSION['date_user']?></a>
            <div id="flex">
                <a class="btn btn-primary"  role="button" href="./profil.php">Profil settings</a>
                <a class="btn btn-primary" href="#" role="button">My Event</a>
                <a class="btn btn-primary"  role="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Event</a>
                <a class="btn btn-primary" href="./deconnexion.php" role="button">Deconnexion</a>
            </div>
        </div>



    </header>
    <main>
    <p class="fs-1 text-danger text-center pt-5 position-absolute top-0 start-50">My Event</p>
    <div id="contain" class="container w-auto text-center position-absolute ">
        
        <div class="row row-col-3 justify-content-md-around me-5">
        <?php
            if(isset($_SESSION['id'])){
                $id_user = $_SESSION['id'];
                $req2 = $bdd->prepare('SELECT `id_event`, `name`, `type`, DATE_FORMAT(date, "%d/%m/%Y") as DATE_AFF, `time`, `text`, `style`, `id_user` FROM `events` WHERE `id_user` = :id ORDER BY `date` ASC, `time` ASC');
                $req2->bindParam(':id', $id_user, PDO::PARAM_INT);
                $req2->execute();

                $req3 = $bdd->prepare('SELECT `id_event`, `name`, `type`, DATE_FORMAT(date, "%d/%m/%Y") as DATE_AFF, `time`, `text`, `style`, `id_user` FROM `events` WHERE `id_user` = :id ORDER BY `date` ASC, `time` ASC');
                $req3->bindParam(':id', $id_user, PDO::PARAM_INT);
                $req3->execute();
                $req4 = $req3->fetch(PDO::FETCH_ASSOC);
                if($req4 == NULL){
                    echo    '<div class="card bg-light mb-3 " style="max-width: 100%;">
                    <div class="card-header"> No Event Set</div>
                    
                        <div class="card-header"></div>
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text"></p>
                            </div>
                 </div>';
                }
                while($result = $req2->fetch(PDO::FETCH_ASSOC)){
                    $color = $result['style'];
                    switch ($color) {
                        case '1':
                            $color = 'text-bg-light';
                            break;
                        case '2':
                            $color = 'text-bg-secondary';
                            break;
                        case '3':
                            $color = 'text-bg-success';
                            break;
                        case '4':
                            $color = 'text-bg-danger';
                            break;
                        case '5':
                            $color = 'text-bg-warning';
                            break;
                        case '6':
                            $color = 'text-bg-info';
                            break;
                        case '7':
                            $color = 'text-bg-dark';
                            break;
                    } 
                    
                    echo '<div class="card '. $color .' mb-3 " style="max-width: 18rem;">
                            <div class="card-header">'. $result['name'] .'</div>
                            
                                <div class="card-header">'. $result['DATE_AFF'] .' '. $result['time'].'</div>
                                    <div class="card-body">
                                        <h5 class="card-title">'. $result['type'] .'</h5>
                                        <p class="card-text">'. $result['text'] .'</p>
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal'.$result['id_event'].'">Edit</button>
                                        <a class="btn btn-primary" role="button" href="delete.php?id='.$result['id_event'].'">Delete</a>
                                    </div>
                         </div>';
                        $date = explode('/',$result['DATE_AFF']);
                        $newdate = $date[2].'-'.$date[1].'-'.$date[0];
                        echo '<div class="modal fade text-start" id="exampleModal'.$result['id_event'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Event</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form id="event'.$result['id_event'].'" action="updatevent.php?id='.$result['id_event'].'" method="POST">
                                                <div class="mb-3">
                                                    <label for="eventname" class="form-label">Event Name</label>
                                                    <input type="text" class="form-control" required id="eventname" name="eventname" aria-describedby="eventname" value="'.$result['name'].'">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventtype" class="form-label">Event Place</label>
                                                    <input type="text" class="form-control" id="eventtype" name="eventtype" value="'.$result['type'].'">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventtext" class="form-label">Event Text Content</label>
                                                    <textarea maxlength="150"class="form-control" id="eventtext" name="eventtext" aria-label="With textarea">'. $result['text'] .'</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventdate" class="form-label">Event Date</label>
                                                    <input type="date" required class="form-control" id="eventdate" name="eventdate" value="'. $newdate .'">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventtime" class="form-label">Event Time</label>
                                                    <input type="time" required class="form-control" id="eventtime"value="'.$result['time'].'" name="eventtime">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventstyle'.$result['id_event'].'" class="form-label">Event Style Color</label>
                                                    <select name="eventstyle'.$result['id_event'].'" form="event'.$result['id_event'].'" id="eventstyle'.$result['id_event'].'" class="form-select" aria-label="Default select example">
                                                        <option value="1">None</option>
                                                        <option value="2">Grey</option>
                                                        <option value="3">Green</option>
                                                        <option value="4">Red</option>
                                                        <option value="5">Yellow</option>
                                                        <option value="6">Blue</option>
                                                        <option value="7">Dark</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>';
                }
                

            }
            

        ?>
        </div>
    </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Event Parameter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="event2" action="addevent.php" method="POST">
                            <div class="mb-3">
                                <label for="eventname" class="form-label">Event Name</label>
                                <input type="text" class="form-control" required id="eventname" name="eventname" aria-describedby="eventname">
                            </div>
                            <div class="mb-3">
                                <label for="eventtypeajax" class="form-label">Event City / Ville / Place</label>
                                <input type="text" list="ville" class="form-control" id="eventtypeajax" name="eventtypeajax" placeholder="Search for a city">
                                <datalist id="ville">
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="eventtext" class="form-label">Event Text Content</label>
                                <textarea maxlength="150"class="form-control" id="eventtext" name="eventtext" aria-label="With textarea"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="eventdate" class="form-label">Event Date</label>
                                <input type="date" required class="form-control" id="eventdate" name="eventdate">
                            </div>
                            <div class="mb-3">
                                <label for="eventtime" class="form-label">Event Time</label>
                                <input type="time" required class="form-control" id="eventtime" name="eventtime">
                            </div>
                            <div class="mb-3">
                                <label for="eventstyleb" class="form-label">Event Style Color</label>
                                <select name="eventstyleb" form="event2" id="eventstyleb" class="form-select" aria-label="Default select example">
                                    <option selected value="1">None</option>
                                    <option value="2">Grey</option>
                                    <option value="3">Green</option>
                                    <option value="4">Red</option>
                                    <option value="5">Yellow</option>
                                    <option value="6">Blue</option>
                                    <option value="7">Dark</option>
                                </select>
                            </div>
                            
                            
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-events">Add Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="./ajax.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>