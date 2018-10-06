<nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
        <div class="row">

            <form class="form-inline justify-content-center" action="index.php?Jeux&action=rechercherJeux" method="post">

                <div class="row" >
                    <div class="col-md-3">
                        <select name="plateforme" id="plateforme" class="form-control mx-sm-3" style="width: 100%">
                            <option value="">Plateforme</option>
                            <?php
                            $counter = count($donnees['plateforme']);

                            for ($i = 0; $i <= $counter -1; $i++) {
                                echo '<option value="'.  $donnees['plateforme'][$i]->getPlateformeId() .'">' . $donnees['plateforme'][$i]->getPlateforme() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="transaction" id="transaction" class="form-control mx-sm-3" style="width: 100%">
                            <option value='' selected>Je cherche un jeux à ...</option>
                            <option value="0" <?php if ($_SESSION["rechercher"]["transaction"] == '0') echo 'selected'; ?>>Vendre</option>
                            <option value="1" <?php if ($_SESSION["rechercher"]["transaction"] == '1') echo 'selected'; ?>>Louer</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control mx-sm-3" style="width: 100%">
                            <option>Évaluation</option>
                            <option>Pas encore fonctionnel</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input name="titre" id="titre" type="text" class="form-control" placeholder="Chercher par mot-clé" style="width: 100%" value="<?= isset($_SESSION["rechercher"]['titre']) ? $_SESSION["rechercher"]['titre'] : '' ?>">
                    </div>

                    <div class="d-flex flex-wrap justify-content-between ml-3 my-3">
                        <?php
                            $counter = count($donnees['categories']);

                            for ($i = 0; $i < $counter; $i++) { ?>
                                <div class="col-lg-3">
                                <input  type="checkbox" value="'<?= $donnees['categories'][$i]->getCategorieId() ?>'" name=categories<?= $donnees['categories'][$i]->getCategorieId() - 1 ?> <?= isset($_SESSION["rechercher"]['categories' . $i]) ? $_SESSION["rechercher"]['categories' . $i] : '' ?>> <?= $donnees['categories'][$i]->getCategorie() ?>
                                </div>
                            <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success ml-4">Chercher</button>
                    <a href="index.php?Jeux&action=resetRecherche" class="btn btn-warning ml-4">Reset recherche</a>
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
                 if ($images[$i]) {
                 echo            '<img class="card-img-top" src="' . $images[$i]->getCheminPhoto() .'" alt="Card image cap">';
                }
                 else {
                 echo            '<img class="card-img-top" src="images/image_defaut.png" alt="Card image cap">';
                }
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



