<?php

include 'config/autoload.php';
include 'config/db.php';
include 'partials/header2.php';


$manager = new Manager($db);
$operateur = $_GET['id'];
$nom = $_GET['name'];

$listeReview = $manager->getReviewByoperator($operateur);

?>

<style>

.tde {height:20px;width:20px;cursor:pointer;}
#value {height:20px; width: 87px; background:gold;}
#glob {display: flex;}

</style>

<?= "<h1>" . ucfirst($nom) . "</h1>" ?>

  <div id="value">

      <div id="glob" >
        <img id="tde_1" src="assets/starBl.png" class="tde"/>
        <img id="tde_2" src="assets/starBl.png" class="tde"/>
        <img id="tde_3" src="assets/starBl.png" class="tde"/>
        <img id="tde_4" src="assets/starBl.png" class="tde"/>
        <img id="tde_5" src="assets/starBl.png" class="tde"/>
      </div>

  </div>

<?php

$listeDestination = $manager->getDestinationByoperator($operateur);

?>
<div class="container">
  <div class="row destinations">
    <?php

    foreach ($listeDestination as $voyage) {
    ?>
        <div class="col-12 col-md-6 col-lg-4 destinations">
        <div class="card" style="width: 18rem;">
          <img src="<?=$voyage['destination']->getImage()?>" class="card-img-top" alt="...">
          <div class="card-body">
          <h5 class="card-title"><?=strtoupper($voyage['destination']->getLocation())?></h5>
          <p class="card-text"><?=ucfirst($voyage['destination']->getPrice())?> €</p>
          </div>
          <a href="<?=$voyage['operator']->getLink()?>" target="_blank" class="btn orange">Lien vers le site</a>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>
<?php

if (isset($_POST['author']) && isset($_POST['message'])) {
  $review = new Review(['message' => $_POST['message'], 'author' => $_POST['author'], 'id_tour_operator' => $operateur]);
  $createReview = $manager->createReview($review);
}

?>
<div class="espace-commentaire">
  <?php
  foreach ($listeReview as $review) {

    echo "<p>" . 'Author : ' . ucfirst($review['review']->getAuthor()) . "<br>Review : " . ucfirst($review['review']->getMessage()) . "</p>";
  }
  ?>
  <form action="config/addReview.php?name=<?=$nom?>&id=<?=$operateur?>" method="post">

    <p>
      Nom : <input type="text" name="author" maxlength="50" required>
      Review : <input type="text" name="message" required>
      <input id="poste" type="submit" value="Poster" name="send" class="orange">
    </p>

  </form>
</div>
<?php

include 'partials/footer.php';
