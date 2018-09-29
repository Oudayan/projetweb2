<nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#hamburguer-chercher">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="hamburguer-chercher">

            <form class="form-inline justify-content-center" action="#" method="post">

                <select name="categorie" id="categorie" class="form-control mx-sm-3">
                    <option value="">Catégorie</option>
                    <?php

                    for ($i = 0; $i <= count($donnees['categories']) -1; $i++) {
                        echo "<option value='" .  $donnees['categories'][$i]->getCategorie() . "'>" . $donnees['categories'][$i]->getCategorie() . "</option>";
                    }
                    ?>
                </select>

                <select name="plateforme" id="plateforme" class="form-control mx-sm-3">
                    <option value="">Plateforme</option>
                    <?php

                    for ($i = 0; $i <= count($donnees['plateforme']) -1; $i++) {
                        echo "<option value='" .  $donnees['plateforme'][$i]->getPlateforme() . "'>" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                    }
                    ?>
                </select>

                <select name="concepteur" id="concepteur" class="form-control mx-sm-3">
                    <option value="">Concepteur</option>
                    <?php

                    for ($i = 0; $i <= count($donnees["concepteurs"]) -1; $i++) {
                        echo "<option value='" .  $donnees['concepteurs'][$i]->getConcepteur() . "'>" . $donnees['concepteurs'][$i]->getConcepteur() . "</option>";
                    }
                    ?>
                </select>

                <select name="negotiation" id="negotiation" class="form-control mx-sm-3">
                    <option value="">Type de négotiation</option>
                    <option value="Acheter">Acheter</option>
                    <option value="Louer">louer</option>
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

                $categorie = $_POST['categorie'];
                $plateforme = $_POST['plateforme'];
                $concepteur = $_POST['concepteur'];
                $negotiation = $_POST['negotiation'];

            if (isset($_POST['categorie']) && isset($_POST['submit'])){
                echo $_POST['categorie'];
            } else {
                echo "NON";
            }

            $counter = count($donnees['derniers']);

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


