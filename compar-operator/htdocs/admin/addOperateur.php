<?php

include('../config/db.php');
include('../config/autoload.php');

$manager = new Manager($db);

if (isset($_POST['name'])&& isset($_POST['grade'])&& isset($_POST['link'])&& isset($_POST['link']) && isset($_POST['is_premium'])) {

    $tourOperator = new TourOperator(['name'=>$_POST['name'], 'grade'=>$_POST['grade'],'link'=>$_POST['link'], 'is_premium'=>intval($_POST['is_premium'])]);

    $createTourOperator = $manager->createTourOperator($tourOperator);

}


header('Location: gestionAdmin.php');