<?php
include('../config/db.php');
include('../config/autoload.php');

$manager = new Manager($db);

$id = $_GET['id'];

$destination = new Destination(['id_tour_operator'=>$id]);

    
$deleteDestination = $manager->deleteDestination($destination);


header("Location:gestionAdmin.php");