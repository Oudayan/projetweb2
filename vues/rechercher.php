<nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#hamburguer-chercher">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="hamburguer-chercher">

            <form class="form-inline justify-content-center" action="<?= $_POST['action'] ?>" method="post">

                <select name="categorie" id="categorie" class="form-control mx-sm-3">
                    <option value="" <?= ($_POST["categorie"] == '' ? 'selected' : '') ?>>Catégories</option>
                    <option value="1" <?= ($_POST["categorie"] == 1 ? 'selected' : '') ?>>Action</option>
                    <option value="2" <?= ($_POST["categorie"] == 2 ? 'selected' : '') ?>>Combat</option>
                    <option value="3" <?= ($_POST["categorie"] == 3 ? 'selected' : '') ?>>Aventure</option>
                    <option value="4" <?= ($_POST["categorie"] == 4 ? 'selected' : '') ?>>Sports</option>
                    <option value="5" <?= ($_POST["categorie"] == 5 ? 'selected' : '') ?>>Course</option>
                    <option value="6" <?= ($_POST["categorie"] == 6 ? 'selected' : '') ?>>Simulation</option>
                    <option value="7" <?= ($_POST["categorie"] == 7 ? 'selected' : '') ?>>Stratégie</option>
                    <option value="8" <?= ($_POST["categorie"] == 8 ? 'selected' : '') ?>>Plate-forme</option>
                    <option value="9" <?= ($_POST["categorie"] == 9 ? 'selected' : '') ?>>Labyrinthe</option>
                    <option value="10" <?= ($_POST["categorie"] == 10 ? 'selected' : '') ?>>Musique</option>
                    <option value="11" <?= ($_POST["categorie"] == 11 ? 'selected' : '') ?>>Jeu de tir à la première personne</option>
                </select>

                <select name="plateforme" id="plateforme" class="form-control mx-sm-3">
                    <option value="" <?= ($_POST["plateforme"] == '' ? 'selected' : '') ?>>Plateforme</option>
                    <option value="1" <?= ($_POST["plateforme"] == 1 ? 'selected' : '') ?>>Playstation 4</option>
                    <option value="2" <?= ($_POST["plateforme"] == 2 ? 'selected' : '') ?>>Xbox One</option>
                    <option value="3" <?= ($_POST["plateforme"] == 3 ? 'selected' : '') ?>>Nintendo Wii U</option>
                    <option value="4" <?= ($_POST["plateforme"] == 4 ? 'selected' : '') ?>>Windows</option>
                    <option value="5" <?= ($_POST["plateforme"] == 5 ? 'selected' : '') ?>>Playstation 3</option>
                    <option value="6" <?= ($_POST["plateforme"] == 6 ? 'selected' : '') ?>>Xbox 360</option>
                    <option value="7" <?= ($_POST["plateforme"] == 7 ? 'selected' : '') ?>>Nintendo Switch</option>
                    <option value="8" <?= ($_POST["plateforme"] == 8 ? 'selected' : '') ?>>Playstation Vita</option>

                </select>

                <select name="negotiation" id="negotiation" class="form-control mx-sm-3">
                    <option value='' <?= ($_POST["negotiation"]) == null ?> selected>Je cherche un jeux à ...</option>
                    <option value="0" <?= ($_POST["negotiation"]) == 0 ?>>Vendre</option>
                    <option value="1" <?= ($_POST["negotiation"]) == 1 ?>>Louer</option>
                </select>
                <input type="submit" name="submit" />
            </form>
        </div>
    </div>
</nav>
<div class="py-2 bg-light">
    <div class="container">
        <div class="row">

            <?php



             $counter = count($donnees['filter']);

            echo '<pre>';
            var_dump($donnees['filter']);
            echo '</pre>';


             for ($i = 0; $i <= $counter -1; $i++) {


                 echo    '<div class="col-md-4">';
                 echo        '<div class="card mb-4 box-shadow cardjeux">';
                 echo            '<img class="card-img-top" src="' . $donnees['images'][$i]->getCheminPhoto() .'" alt="Card image cap">';
                 echo            '<div class="card-body">';
                 echo                '<p class="card-text">' . $donnees['derniers'][$i]->getTitre() . '</p>';
                 echo                '<div class="d-flex justify-content-between align-items-center">';
                 echo                    '<div class="btn-group">';
                 echo                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href=\'index.php?Jeux&action=afficherJeu&JeuxId=' . $donnees['derniers'][$i]->getJeuxId() . ' \' ">Détails</button>';
                 echo                        '<button type="button" class="btn btn-sm btn-outline-secondary">' . ($donnees["derniers"][$i]->getLocation() == 1 ? "Louer" : "Acheter") . '</button>';
                 echo                    '</div>';
                 echo                    '<small class="text-muted">Prix : ' . $donnees['derniers'][$i]->getPrix() . ' $CAD</small>';
                 echo                '</div>';
                 echo           '</div>';
                 echo        '</div>';
                 echo    '</div>';

             }



            ?>
        </div>
    </div>