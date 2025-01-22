<?php
    session_start();

    include './dbh.class.php';
    $connection = new Dbh;

    $id_event = $_GET['id'];

    $bdd = $connection->getConnection();
    $req = $bdd->prepare("DELETE FROM `events` WHERE `events`.`id_event` = :id;");
    $req->bindParam(":id", $id_event, PDO::PARAM_INT);
    $req->execute();

    header('Location: events.php');