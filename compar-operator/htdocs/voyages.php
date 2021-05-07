<?php

include 'config/autoload.php';
include 'config/db.php';

include 'partials/header2.php';

$manager = new Manager($db);
$location = $_GET['location'];

$operators = $manager->getOperatorByDestination($location);

echo "<h1 class='title-destination'>" . strtoupper($location) . "</h1>";

?>
<div class="container">
  <div class="row destinations">
    <?php

    foreach ($operators as $operator) {

      if ($operator['operator']->getIsPremium() === 1) {

        // echo "<h2>" . ucfirst($operator['operator']->getName()) . "</h2><a href='operateur.php?name=" . $operator['operator']->getName() . "&id=" . $operator['operator']->getId() . "'>Voir toutes les offres de cet opérateur</a>";
        // echo "<p>Prix : " . $operator['destination']->getPrice() . " €</p>";
    ?>
        <div class="col-12 col-md-6 col-lg-4 destinations">
          <div class="card text-center" style="width: 18rem;">
            <img src="./assets/bgImgAgenceVoyage.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h3 class="card-title"><?= ucfirst($operator['operator']->getName()) ?></h5>
                <p class="card-text">Prix : <?= $operator['destination']->getPrice() ?>€</p>
                <a href="operateur.php?name=<?= $operator['operator']->getName()?>&id=<?=$operator['operator']->getId()?>" class="btn orange">Voir les offres de cet opérateur</a>
            </div>
          </div>
        </div>
      <?php
      } else {

        // echo "<h4>" . ucfirst($operator['operator']->getName()) . "</h4><a href='operateur.php?name=" . htmlspecialchars($operator['operator']->getName()) . "&id=" . $operator['operator']->getId() . "'>Voir toutes les offres de cet opérateur</a>";
        // // echo "<p>Prix : " . $operator['destination']->getPrice() . " €</p>";
      ?>
        <div class="col-12 col-md-6 col-lg-4 destinations">
          <div class="card text-center" style="width: 18rem;">
            <img src="./assets/bgImgAgenceVoyage.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title"><?=ucfirst($operator['operator']->getName())?></h5>
                <p class="card-text">Prix : <?=$operator['destination']->getPrice()?>€</p>
                <a href="operateur.php?name=<?= htmlspecialchars($operator['operator']->getName()) ?>&id=<?=$operator['operator']->getId()?>" class="btn orange">Voir les offres de cet opérateur</a>
            </div>
          </div>
        </div>

    <?php

      }
    }

    ?>

  </div>
</div>

<?php

include 'partials/footer.php';
