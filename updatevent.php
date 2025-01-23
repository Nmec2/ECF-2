<?php

session_start();

    include './dbh.class.php';
    $connection = new Dbh;
    $bdd = $connection->getConnection();

    if(isset($_POST['submit'])){
        $id_event = $_GET['id'];
        $eventname = $_POST['eventname'];
        $eventtype = $_POST['eventtype'];
        $eventtext = $_POST['eventtext'];
        $eventdate = $_POST['eventdate'];
        $eventime = $_POST['eventtime'];
        $eventstyle = $_POST['eventstyle'.$id_event.''];
        echo $eventstyle;
        
        $req = $bdd->prepare("UPDATE `events` SET `name`= :name,`type`= :type,`date`= :date, `time`=:time, `text`= :text,`style`= :style WHERE  `id_event` = :id");
        $req->execute(array(':name' => $eventname,
                            ':type' => $eventtype,
                            ':date' => $eventdate,
                            ':time' => $eventime,
                            ':text' => $eventtext,
                            ':style' => $eventstyle,
                            ':id' => $id_event
        ));
        
        header('Location: events.php');
    } 