<div id="barre-recherche" class="bg-dark">
    <form class="form-inline" action="index.php?Jeux&action=rechercherJeux" method="post">

<!--Par Plateforme, Transaction, Évaluation et Calendrier-->

    <div class="container">
            <div class="row mt-2">
                <div class="col-sm">
                    <select name="plateforme" id="plateforme" class="form-control mb-2" style="width: 100%">
                        <option value="">Plateforme</option>
                        <?php
                        $counter = count($donnees['plateforme']);

                        for ($i = 0; $i <= $counter -1; $i++) {
                            echo '<option value="'.  $donnees['plateforme'][$i]->getPlateformeId() .'">' . $donnees['plateforme'][$i]->getPlateforme() . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm">
                    <select name="prix" id="prix" class="form-control mb-2" style="width: 100%">
                        <option value="">Prix - Jusqu'à ...</option>
                        <option value="10" <?php if ($_SESSION["rechercher"]["prix"] == '10') echo 'selected'; ?>>CDN$ 10</option>
                        <option value="25" <?php if ($_SESSION["rechercher"]["prix"] == '25') echo 'selected'; ?>>CDN$ 25</option>
                        <option value="35" <?php if ($_SESSION["rechercher"]["prix"] == '35') echo 'selected'; ?>>CDN$ 35</option>
                        <option value="50" <?php if ($_SESSION["rechercher"]["prix"] == '50') echo 'selected'; ?>>CDN$ 50</option>
                        <option value="70" <?php if ($_SESSION["rechercher"]["prix"] == '70') echo 'selected'; ?>>CDN$ 70</option>
                        <option value="90" <?php if ($_SESSION["rechercher"]["prix"] == '90') echo 'selected'; ?>>CDN$ 80</option>
                        <option value="1000" <?php if ($_SESSION["rechercher"]["prix"] == '1000') echo 'selected'; ?>>Tous les prix</option>
                    </select>
                </div>
                <div class="col-sm">
                    <select name="transaction" class="form-control mb-2" id="transaction" onchange="afficherCal()" style="width: 100%">
                        <option value='' selected>Je cherche un jeux à ...</option>
                        <option value="0" <?php if ($_SESSION["rechercher"]["transaction"] == '0') echo 'selected'; ?>>Vendre</option>
                        <option value="1" <?php if ($_SESSION["rechercher"]["transaction"] == '1') echo 'selected'; ?>>Louer</option>
                    </select>
                </div>
                <div class="col-sm">
                    <input style="width: 100%; display: none" type="text" id="datesLocation" name="datesLocation" class="form-control mb-2" value="<?= isset($_SESSION["rechercher"]['datesLocation']) ? $_SESSION["rechercher"]['datesLocation'] : '' ?>">
                </div>
            </div>
        </div>

<!--Par Catégorie-->

        <div class="container">
            <div class="row">
                <div class="pb-2">
                    <button type="button" class="btn btn-info ml-3" data-toggle="collapse" data-target="#categories">Catégories</button></div>
                <div id="categories" class="collapse<?= isset($donnees["catShow"]) ? $donnees["catShow"] : "" ?>">
                <div class="d-flex flex-wrap justify-content-between my-2">
                    <?php
                    $counter = count($donnees['categories']);

                    for ($i = 0; $i < $counter; $i++) { ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <input type="checkbox" value="'<?= $donnees['categories'][$i]->getCategorieId() ?>'" name=categories<?= $donnees['categories'][$i]->getCategorieId() - 1 ?> <?= isset($_SESSION["rechercher"]['categories' . $i]) ? $_SESSION["rechercher"]['categories' . $i] : '' ?>> <a style="color: whitesmoke"> <?= $donnees['categories'][$i]->getCategorie() ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
           </div>
        </div>

<!--Par mot clé et buttons recherche et reset-->

        <div class="container">
            <div class="row">
                <div class="col-sm pb-2"><input name="titre" id="titre" type="text" class="form-control" placeholder="Chercher par mot-clé" style="width: 100%" value="<?= isset($_SESSION["rechercher"]['titre']) ? $_SESSION["rechercher"]['titre'] : '' ?>">
                </div>
                <div class="col-sm mb-2"><a style="width: 100%" href="index.php?Jeux&action=resetRecherche" class="btn btn-danger">Reset recherche</a>
                </div>
                <div class="col-sm mb-2"><input style="width: 100%" type="submit" value="Chercher" class="btn btn-success" >
                </div>

            </div>
        </div>
    </form>
</div>

<div class="py-2">
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow cardjeux">
                    <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>"><img class="card-img-top" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="Card image cap"></a>
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
        // singleDatePicker: true,
        // showDropdowns: true,
        // minYear: 2018,
        // maxYear: parseInt(moment().format('YYYY'),10),
        "locale": {
            "direction": "ltr",
            "format": "YYYY-MM-DD",
            "separator": " au ",
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


    // Affichage et masquage du champs de calendrier selon option de transaction

    let cal = document.getElementById("datesLocation");

    function afficherCal() {
        let louer = document.getElementById("transaction").value;
        if (louer == '1') {
            cal.style.display = 'block';
        }
        else {
            cal.style.display = 'none';
            // cal.value = '';

        }
    }

    window.addEventListener('load', function () {

        let louer = document.getElementById("transaction").value;
        if (louer == '1') {
            cal.style.display = 'block';
        }
        else {
            cal.style.display = 'none';
            // cal.value = '';
        }

    });
</script>



