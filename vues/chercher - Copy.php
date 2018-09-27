<nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#hamburguer-chercher">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="hamburguer-chercher">
            <form class="form-inline justify-content-center" action="index.php?Jeux&action=rechercher">

                <select class="form-control mx-sm-3" id="exampleFormControlSelect1">
                    <option>Catégorie</option>
                    <?php

                    for ($i = 0; $i <= count($donnees['categories']) -1; $i++) {
                        echo "<option>" . $donnees['categories'][$i]->getCategorie() . "</option>";
                    }
                    ?>
                </select>

                <select class="form-control mx-sm-3" id="exampleFormControlSelect2">
                    <option>Plateforme</option>
                    <?php

                    for ($i = 0; $i <= count($donnees['plateforme']) -1; $i++) {
                        echo "<option>" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                    }
                    ?>
                </select>

                <select class="form-control mx-sm-3" id="exampleFormControlSelect3">
                    <option>Concepteur</option>
                    <?php

                    for ($i = 0; $i <= count($donnees["concepteurs"]) -1; $i++) {
                        echo "<option>" . $donnees["concepteurs"][$i]->getConcepteur() . "</option>";
                    }
                    ?>
                </select>

                <select class="form-control mx-sm-3" id="exampleFormControlSelect4">
                    <option>Type de négotiation</option>
                    <option>Acheter</option>
                    <option>louer</option>
                </select>

                <button type="submit" class="btn btn-primary">Trouver</button>
            </form>
        </div>
    </div>
</nav>

<div class="py-2 bg-light">
    <div class="container">
        <div class="row">


            <?php

            //            var_dump(count($donnees['categories']->getCategorie()));
            //            var_dump($donnees["negotiation"][1]->getLocation());
            //            var_dump($donnees["concepteurs"][0]->getConcepteur());


//            $counter = count($donnees['derniers']);



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


