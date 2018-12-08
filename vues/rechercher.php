<div id="barre-recherche" class="bg-dark">
    <form class="form-inline" action="index.php?Jeux&action=rechercherJeux" method="post">

<!--Par Plateforme, Transaction, Évaluation et Calendrier-->

    <div class="container">
            <div class="row mt-2">
                <div class="col-sm">
                    <select name="plateforme" id="plateforme" class="form-control mb-2" style="width: 100%">
                        <option value="" selected>Plateforme</option>
                        <?php
                        for ($i = 0; $i < count($donnees['plateforme']); $i++) { ?>
                            <option value="<?=  $donnees['plateforme'][$i]->getPlateformeId() ?>" <?= isset($_SESSION["rechercher"]["plateforme"]) && $_SESSION["rechercher"]["plateforme"] == $donnees['plateforme'][$i]->getPlateformeId() ? 'selected' : "" ?>><?=  $donnees['plateforme'][$i]->getPlateforme() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm">
                    <select name="prix" id="prix" class="form-control mb-2" style="width: 100%">
                        <option value="">Prix - Jusqu'à ...</option>
                        <option value="10" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '10' ?  'selected' : "" ?>>10 <small>$CAD</small></option>
                        <option value="25" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '25' ?  'selected' : "" ?>>25 <small>$CAD</small></option>
                        <option value="35" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '35' ?  'selected' : "" ?>>35 <small>$CAD</small></option>
                        <option value="50" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '50' ?  'selected' : "" ?>>50 <small>$CAD</small></option>
                        <option value="70" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '70' ?  'selected' : "" ?>>70 <small>$CAD</small></option>
                        <option value="90" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '90' ?  'selected' : "" ?>>80 <small>$CAD</small></option>
                        <option value="1000000" <?= isset($_SESSION["rechercher"]["prix"]) && $_SESSION["rechercher"]["prix"] == '1000000' ?  'selected' : "" ?>>Tous les prix</option>
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

    <?php
        if(count($donnees['jeux']) == 0) {
            echo '<h2 class="text-center my-4"> Aucun jeu trouvé! </h2>';
    } else {
    ?>

<div class="py-2">
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow cardjeux">
                    <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>"><img class="card-img-top" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="Card image cap"></a>
                    <div class="card-body">
                        <h5 class="card-text text-center"><?= $donnees['jeux'][$i]->getTitre() ?></h5>
                        <p class="pt-2"><?= $donnees["plateformeJeu"][$i]->getPlateformeIcone() . " " . $donnees["plateformeJeu"][$i]->getPlateforme() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <h6><?= $donnees["jeux"][$i]->getLocation() == 1 ? "À louer" : "À vendre" ?></h6>
                                <!-- <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>" class="btn btn-sm btn-outline-secondary">Détails</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><?= $donnees["jeux"][$i]->getLocation() == 1 ? "Louer" : "Acheter" ?></a> -->
                            </div>
                            <span class="text-muted">Prix : <?= round($donnees['jeux'][$i]->getPrix(), 2) ?> <small>$CAD</small> <?= $donnees["jeux"][$i]->getLocation() ? "par jour" : "" ?></span></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php }} ?>

        </div>
    </div>


<script>
    $('#datesLocation').daterangepicker({
        "minYear": new Date().getFullYear(),
        "minDate": new Date(),
        "showDropdowns": true,
        "autoApply": true,
        "dateLimit": {
            "months": 3
        },
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
            "firstDay": 1,
        },
        "opens": "left"
        
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



