<?php
    session_start();

    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    if(isset($_POST['submit-events'])){
        
        $eventname = $_POST['eventname'];
        $eventtype = $_POST['eventtype'];
        $eventtext = $_POST['eventtext'];
        $eventdate = $_POST['eventdate'];
        $eventstyle = $_POST['eventstyle'];
        $id_user = $_SESSION['id'];
        $req = $bdd->prepare("INSERT INTO `events`(`name`, `type`, `date`, `text`, `style`, `id_user`) VALUES (:name, :type, :date, :text, :style, :id_user)");
        $req->execute(array(':name' => $eventname,
                            ':type' => $eventtype,
                            ':date' => $eventdate,
                            ':text' => $eventtext,
                            ':style' => $eventstyle,
                            ':id_user' => $id_user
                        ));
        header('Location: events.php');
    } else {
        header('Location: events.php');
    }