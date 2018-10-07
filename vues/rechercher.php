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
                    <input type="text" name="datesLocation" id="datesLocation">
                    <button type="submit" class="btn btn-success ml-4">Chercher</button>
                    <a href="index.php?Jeux&action=resetRecherche" class="btn btn-warning ml-4">Reset recherche</a>
            </form>
        </div>
    </div>
</nav>

<div class="py-2 bg-light">
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow cardjeux">
                    <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>"><img class="card-img-top" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"><?= $donnees['jeux'][$i]->getTitre() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>" class="btn btn-sm btn-outline-secondary">Détails</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><?= $donnees["jeux"][$i]->getLocation() == 1 ? "Louer" : "Acheter" ?></a>
                            </div>
                            <small class="text-muted">Prix : <?= round($donnees['jeux'][$i]->getPrix(), 2) ?> $CAD</small>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


<script>
    $('#datesLocation').daterangepicker({
        "showDropdowns": true,
        "autoApply": true,
        "dateLimit": {
            "months": 3
        },
        "locale": {
            "direction": "ltr",
            "format": "YYYY-MM-DD",
            "separator": "  au  ",
            "applyLabel": "Sélectionner",
            "cancelLabel": "Annuler",
            "fromLabel": "Du",
            "toLabel": "Au",
            "customRangeLabel": "Sur mesure",
            "daysOfWeek": [
                "Di",
                "Lu",
                "Ma",
                "Me",
                "Je",
                "Ve",
                "Sa"
            ],
            "monthNames": [
                "Janvier",
                "Février",
                "Mars",
                "Avril",
                "Mai",
                "Juin",
                "Juillet",
                "Août",
                "Septembre",
                "Octobre",
                "Novembre",
                "Décembre"
            ],
            "firstDay": 1
        },
        // Si la disponibilité dateDebut est assignée en $_SESSION et qu'elle dépasse ou est égale à la date d'aujourd'hui, mettre cette date comme date minimum, sinon la date minimum est égale à aujourd'hui
<!--        --><?//= (isset($_SESSION['disponibilite']['dateDebut']) && strtotime($_SESSION['disponibilite']['dateDebut']) >= date("Y-m-d") ? '"minDate": "' . $_SESSION['disponibilite']['dateDebut'] . '", ' : '"minDate": new Date(), ') ?>
//        // Si la disponibilité dateFin est assignée en $_SESSION, mettre cette date comme date maximum, sinon, pas de date maximum
//        <?//= (isset($_SESSION['disponibilite']['dateFin'])) ? '"maxDate": "' . $_SESSION['disponibilite']['dateFin'] . '", ' : '') ?>
//        // Si la date de début du formulaire recherche est assigné en $_SESSION, mettre cette date comme date de début de la sélection, sinon à la date d'aujourd'hui
//        <?//= (isset($_SESSION['recherche']['debutLocation']) ? '"startDate": "' . $_SESSION['recherche']['debutLocation'] . '", ' : ' "startDate": "' . strtotime(date("Y-m-d")) . '", ' ?>
//        // Si la date de fin du formulaire recherche est assigné en $_SESSION, mettre cette date comme date de fin de la sélection, sinon à la date de demain
//        <?//= (isset($_SESSION['recherche']['finLocation']) ? '"endDate": "' . $_SESSION['recherche']['finLocation'] . '", ' : '"endDate": "' . strtotime(date("Y-m-d") + 1 day) . '", ' ?>
//        "applyClass": "btn-orange"
    }, function(start, end, label) {
        console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });
</script>

