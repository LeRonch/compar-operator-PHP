<?php

include ('../config/db.php');
include ('../config/autoload.php');

$manager = new Manager($db);

$operateur = $_GET['id'];
$nom = $_GET['name'];


if (isset($_POST['author'])&& isset($_POST['message']) ) {

    $review = new Review(['message'=>$_POST['message'], 'author'=>$_POST['author'],'id_tour_operator'=>$operateur ]);
  
    $createReview = $manager->createReview($review);
  
  }

header('Location:../operateur.php?name='.$nom.'&id='.$operateur);