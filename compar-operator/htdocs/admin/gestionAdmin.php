<?php
session_start();
include('../config/db.php');
include('../config/autoload.php');
include('linkcss.php');


$manager = new Manager($db);

$locations = $manager->getEverything();
$listeOperateur = $manager->getAllOperator();

?>

<h1 style="color: whitesmoke;"><strong>Liste des Destinations : </strong></h1>

<div class="container">

    <div class="row d-flex justify-content-around">

        <?php
        foreach ($locations as $everything) {
        ?>

            <div class=" col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-around">
                <div class="card" style="width: 21rem;">

                    <div class="card-body">

                        <h5 class="card-title">Offre n°<?= $everything['destination']->getId() ?></h5>

                        <h5 class="card-subtitle mb-2"><?= ucfirst($everything['destination']->getLocation()) ?></h5>

                        <p class="card-text"><?= ucfirst($everything['destination']->getPrice()) . " € avec <strong>" . ucwords($everything['operator']->getName()) ?></strong></p>

                        <span id="suppr">Supprimer</span> <i class="fa fa-arrow-right" aria-hidden="true"></i><a id='poubelle' href='deleteDestination.php?id=<?= $everything['destination']->getId()?>'> <i class="fa fa-trash-o" aria-hidden="true"></i> </a><i class="fa fa-arrow-left" aria-hidden="true"></i>

                    </div>

                </div>
            </div>

        <?php } ?>

    </div>

</div>

<br>
<br>

<div id="login">

    <form class='login-form' action="addDestination.php" method="post">

        <h3>Nouvelle Destination</h3><br>

        Destination : <input type="text" name="location" maxlength="50" placeholder="&#xf072;" required>

        Prix : <input type="number" placeholder="€" name="price" required>

        Tour Operateur : <select name="id_tour_operator" id="">
            <?php foreach ($listeOperateur as $opId) {

                echo "<option value='" . $opId->getId() . "'>" . ucwords($opId->getName()) . "</option>";
            } ?>
        </select><br>

        Image (URL): <input placeholder="https://" type="text" name="image" maxlength="255" required>

        <br><br>

        <input class="lf--submit" type="submit" value="Ajouter Destination" name="send">

    </form>

</div>
<?php

echo '<br><hr>';

?>

<h1 style="color: whitesmoke;"><strong>Liste des Opérateurs : </strong></h1>

<div class='container'>

    <div class='row d-flex justify-content-around'>

    <?php foreach ($listeOperateur as $operateur) {

        if ($operateur->getIsPremium() === 1) { ?>

                <div class='col-12 col-lg-6 d-flex justify-content-around'>

                <div id="operateur" style="width: 30rem;">

                        <h2><span id='gold'><i class='fa fa-money' aria-hidden='true'></i></span> <?= ucwords($operateur->getName()) ?></h2>

                <?php } else { ?>

                    <div class='col-12 col-lg-6 d-flex justify-content-around'>

                    <div id="operateur" style="width: 30rem;">

                        <h2><?= ucwords($operateur->getName()) ?></h2>

                        <?php } ?>

                        <form action='upgradePremium.php' method='post'>

                            <input name='id_tour_operator' type='hidden' value='<?= $operateur->getId() ?>'>

                            Link : <a href='<?= $operateur->getLink() ?>' target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>

                            <br>

                            <?php if ($operateur->getIsPremium() === 1) { ?>

                                Premium : <select name='is_premium' id=''>
                                    <option value='1'>Oui</option>
                                    <option value='0'>Non</option>
                                </select>

                            <?php } else { ?>

                                Premium : <select name='is_premium' id=''>
                                    <option value='0'>Non</option>
                                    <option value='1'>Oui</option>
                                </select>

                            <?php } ?>

                            <br>
                            <input class="submit" type='submit' value='Update' name='send'>

                        </form>

                        <span id="suppr">Supprimer</span> <i class="fa fa-arrow-right" aria-hidden="true"></i><a id="poubelle" style='text-decoration:none;' href='deleteOperateur.php?id=<?= $operateur->getId()?>'> <i class="fa fa-trash-o" aria-hidden="true"></i> </a><i class="fa fa-arrow-left" aria-hidden="true"></i>

                        </div>
                        </div>
                <?php

            }

                ?>
    </div>
</div>
                <br>

                <div id="login">

                    <form class='login-form' action="addOperateur.php" method="post">

                        <h3>Nouveau Tour Opérateur</h3><br>

                        Nom : <input placeholder="( ͡°( ͡° ͜ʖ( ͡° ͜ʖ ͡°)ʖ ͡°) ͡°)" type="text" name="name" maxlength="50" required>

                        Note : <br><input placeholder="ಠ_ಠ" type="number" min="0" max="5" name="grade" required>

                        <br>

                        Lien : <input placeholder="https://" type="text" name="link" maxlength="250" required>

                        <br> Premium : <select name='is_premium' id=''>
                            <option value='0'>Non</option>
                            <option value='1'>Oui</option>
                        </select>

                        <br><br>

                        <input class="lf--submit" type='submit' value='Créer TO' name='send'>

                    </form>

                </div>

            <hr id="end">

        <a id="back" class="lf--submit" href="../index.php">Retour à l'index</a>