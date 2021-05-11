<?php

include 'config/autoload.php';
include 'config/db.php';

include 'partials/header2.php';

$manager = new Manager($db);

$listeOperateur = $manager->getAllOperator();

?>
<h1>Tous les opérateurs :</h1>
<div class="container">
    <div class="row destinations">

        <?php

        foreach ($listeOperateur as $operateur) {
  
        ?>
                <div class="col-12 col-md-6 col-lg-4 destinations">

                    <div class="card text-center" style="width: 18rem;">

                        <img src="./assets/bgImgAgenceVoyage.jpg" class="card-img-top" alt="...">

                        <div class="card-body">

                        <?php if ($operateur->getIsPremium() === 1) { ?>

                            <h5 class="card-title"><?= strtoupper($operateur->getName()) ?> 👑</h5>
                            <?php }else{?>

                            <h5 class="card-title"><?= strtoupper($operateur->getName()) ?></h5>

                            <?php }?>

                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <a href="operateur.php?name=<?=$operateur->getName()?>&id=<?=$operateur->getId()?>" class="btn orange">Voir les offres de cet opérateur</a>

                        </div>

                    </div>

                </div>

            <?php }?>

    </div>

</div>

<?php

include 'partials/footer.php';
