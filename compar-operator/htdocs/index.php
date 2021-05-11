<?php

session_start();
include 'config/autoload.php';
include 'config/db.php';

include 'partials/header.php';

$manager = new Manager($db);

$locations = $manager->getAllDestination();

if(!isset($_SESSION['id']) || !isset($_SESSION['logged_in']) || !isset($_SESSION['name'])){
?>

<h1>Toutes nos destinations :</h1>

<div class="container">
  <div class="row destinations">
    
<?php
    
foreach ($locations as $destination) {

?>
      <div class="col-12 col-md-6 col-lg-4 destinations">
        <div class="card" style="width: 18rem;">
          <img src="<?=$destination->getImage()?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center text-uppercase"><?= ucfirst($destination->getLocation()) ?></h5>
            <p class="card-text text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam quos omnis sint expedita cum ipsa fugiat suscipit facilis repudiandae assumenda.</p>
          </div>
            <a href='voyages.php?location=<?= $destination->getLocation() ?>' class="btn orange text-uppercase">Voir les offres de cette destination !</a>
        </div>
      </div>
<?php

}

?>

  </div>
</div>

<a href="./listeoperateur.php"><button type="button" class="btn orange button-operator">VOIR LES OPÉRATEURS</button></a>

<?php

  }else{

?>

<div id="boxmenu">

  <h3 id="menu">Menu Administrateur</h3>

  <div id='admin'>
    
    <a class='btn orange' href='admin/gestionAdmin.php'>
      Panneau de Gestion ⌨
    </a>

    <a class='btn orange' href='config/deconnexion.php'>
      Déconnexion ❌
    </a>

  </div>

</div>


<div class="container">
  <div class="row destinations">
    
<?php
    
foreach ($locations as $destination) {

?>
      <div class="col-12 col-md-6 col-lg-4 destinations">
        <div class="card" style="width: 18rem;">
          <img src="<?=$destination->getImage()?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center text-uppercase"><?= ucfirst($destination->getLocation()) ?></h5>
            <p class="card-text text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam quos omnis sint expedita cum ipsa fugiat suscipit facilis repudiandae assumenda.</p>
          </div>
            <a href='voyages.php?location=<?= $destination->getLocation() ?>' class="btn orange text-uppercase">Voir les offres de cette destination !</a>
        </div>
      </div>
<?php

}

?>

  </div>
</div>

<a href="./listeoperateur.php"><button type="button" class="btn orange button-operator">VOIR TOUS LES OPÉRATEURS</button></a>

<?php
}

include 'partials/footer.php';
