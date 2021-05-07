<?php
include('../config/db.php');
include('../config/autoload.php');

$manager = new Manager($db);

$id = $_GET['id'];

$operator = new TourOperator(['id'=>$id]);


$deleteOperator = $manager->deleteTourOperator($operator);


header("Location:gestionAdmin.php");