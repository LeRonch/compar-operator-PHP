<?php

include('../config/db.php');
include('../config/autoload.php');

$manager = new Manager($db);

if (isset($_POST['is_premium'])){

    $tourOperator = new TourOperator([
        'is_premium'=>intval($_POST['is_premium']),
        'id'=>intval($_POST['id_tour_operator'])
    ]);

    $upgradePremium = $manager->updateOperatorToPremium($tourOperator);


}

header("Location:gestionAdmin.php");