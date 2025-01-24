<?php

include_once './dbh.class.php';


$connection = new Dbh;
$bdd = $connection->getConnection();
$search = $_POST['eventtypeajax'] . '%';

$req = $bdd->prepare('SELECT `ville_nom` FROM `villes_france_free` WHERE `ville_nom` LIKE :search ORDER BY `ville_population_2012` DESC LIMIT 10');

$req->bindParam('search', $search, PDO::PARAM_STR);

$req->execute();

echo json_encode($req->fetchAll(PDO::FETCH_ASSOC));