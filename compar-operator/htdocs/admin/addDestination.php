<?php

include('../config/db.php');
include('../config/autoload.php');

$manager = new Manager($db);


if (isset($_POST['location'])&& isset($_POST['price'])&& isset($_POST['id_tour_operator'])&& isset($_POST['image'])) {

    $destination = new Destination(['location'=>$_POST['location'], 
    'price'=>$_POST['price'],
    'id_tour_operator'=>$_POST['id_tour_operator'], 
    'image'=>$_POST['image']]);

    $createDestination = $manager->createDestination($destination);

}

header('Location: gestionAdmin.php');