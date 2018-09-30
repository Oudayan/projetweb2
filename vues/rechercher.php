

<nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#hamburguer-chercher">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="hamburguer-chercher">

            <form class="form-inline justify-content-center" action="index.php?Jeux&action=rechercherJeux" method="post">


                <select name="plateforme" id="plateforme" class="form-control mx-sm-3">
                    <option value="">Plateforme</option>
                    <?php
                    $counter = count($donnees['plateforme']);

                    for ($i = 0; $i <= $counter -1; $i++) {
                        echo '<option value="'.  $donnees['plateforme'][$i]->getPlateformeId() .'">' . $donnees['plateforme'][$i]->getPlateforme() . '</option>';
                    }
                    ?>

                </select>

                <select name="negotiation" id="negotiation" class="form-control mx-sm-3">
                    <option value='' <?= ($_POST["negotiation"]) == null ?> selected>Je cherche un jeux à ...</option>
                    <option value="0" <?= ($_POST["negotiation"]) == 0 ?>>Vendre</option>
                    <option value="1" <?= ($_POST["negotiation"]) == 1 ?>>Louer</option>
                </select>
<?php
               $counter = count($donnees['categories']);
               for ($i = 0; $i <= $counter -1; $i++) {
                   echo '<div class="form-check form-check-inline">';
                   echo '<input class="form-check-input" type="checkbox" value="' . $donnees['categories'][$i]->getCategorieId() . '" name=categories[' . $donnees['categories'][$i]->getCategorieId() . ']>';
                   echo '<label class="form-check-label" for="inlineCheckbox1">'. $donnees['categories'][$i]->getCategorie() .'</label>';
                   echo '</div>';
               }
?>

                <input type="submit" name="submit" />
            </form>
        </div>
    </div>
</nav>


<div class="py-2 bg-light">
    <div class="container">
        <div class="row">

            <?php
        
                $modeleImages = $this->lireDAO("Images");

             for ($i = 0; $i < count($donnees['jeux']); $i++) {


                 echo    '<div class="col-md-4">';
                 echo        '<div class="card mb-4 box-shadow cardjeux">';                 
                 $images[$i] = $modeleImages->lireImageParJeuxId($donnees['jeux'][$i]->getJeuxId());
                 echo            '<img class="card-img-top" src="' . $images[$i]->getCheminPhoto() .'" alt="Card image cap">';
                 echo            '<div class="card-body">';
                 echo                '<p class="card-text">' . $donnees['jeux'][$i]->getTitre() . '</p>';
                 echo                '<div class="d-flex justify-content-between align-items-center">';
                 echo                    '<div class="btn-group">';
                 echo                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href=\'index.php?Jeux&action=afficherJeu&JeuxId=' . $donnees['jeux'][$i]->getJeuxId() . ' \' ">Détails</button>';
                 echo                        '<button type="button" class="btn btn-sm btn-outline-secondary">' . ($donnees["jeux"][$i]->getLocation() == 1 ? "Louer" : "Acheter") . '</button>';
                 echo                    '</div>';
                 echo                    '<small class="text-muted">Prix : ' . $donnees['jeux'][$i]->getPrix() . ' $CAD</small>';
                 echo                '</div>';
                 echo           '</div>';
                 echo        '</div>';
                 echo    '</div>';

             }
            ?>
        </div>
    </div>



