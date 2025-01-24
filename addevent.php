<?php
    session_start();

    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    if(isset($_POST['submit-events'])){
        
        $eventname = $_POST['eventname'];
        $eventtype = $_POST['eventtypeajax'];
        $eventtext = $_POST['eventtext'];
        $eventdate = $_POST['eventdate'];
        $eventstyle = $_POST['eventstyleb'];
        $eventime = $_POST['eventtime'];
        var_dump($_POST);
        $id_user = $_SESSION['id'];
        $req = $bdd->prepare("INSERT INTO `events`(`name`, `type`, `date`, `text`, `time`, `style`, `id_user`) VALUES (:name, :type, :date, :text, :time, :style, :id_user)");
        $req->execute(array(':name' => $eventname,
                            ':type' => $eventtype,
                            ':date' => $eventdate,
                            ':text' => $eventtext,
                            ':time' => $eventime,
                            ':style' => $eventstyle,
                            ':id_user' => $id_user
                        ));
        header('Location: events.php');
    } else {
        header('Location: events.php');
    }