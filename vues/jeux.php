<!--/**-->
<!-- * @file      jeux.php-->
<!-- * @author    Guilherme Tosin, Marcelo Guzmán, Oudayan Dutta -->
<!-- * @version   1.0.0-->
<!-- * @date      Septembre 2018-->
<!-- * @brief     Fichier de vue pour les jeux.-->
<!-- * @details   Cette vue permettre voir les détails de chaque jeux-->
<div class="container pt-3">
    <div class="row">
        <!-- Image principale du jeu -->
        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <div id="carouselImagesJeu" class="carousel slide" data-ride="carousel" data-interval="3000">
                        <?php if (count($donnees['images']) > 1) { ?>
                            <ol class="carousel-indicators">
                            <?php for ($i = 0; $i < count($donnees['images']); $i++) {
                                if ($i == 0) { ?>
                                    <li data-target='#carouselImagesJeu' data-slide-to='<?= $i ?>' class='active'></li>
                                <?php } else { ?>
                                    <li data-target='#carouselImagesJeu' data-slide-to='<?= $i ?>'></li>
                                <?php }
                            } ?>
                            </ol>
                        <?php } ?>
                        <div class="carousel-inner">
                        <?php for ($i = 0; $i < count($donnees['images']); $i++) {
                            if ($i == 0) { ?>
                            <div class="carousel-item active">
                            <?php } else { ?>
                            <div class="carousel-item">
                            <?php } ?>
                                <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeu']->getJeuxId() ?>"><img class="d-block w-100" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="<?= $donnees['jeu']->getTitre() ?>"></a>
                            </div>
                        <?php } ?>
                        </div>
                        <?php if (count($donnees['images']) > 1) { ?>
                            <a class="carousel-control-prev" href="#carouselImagesJeu" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselImagesJeu" role="button" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Détails du jeu -->
        <div class="col-12 col-lg-6 add_to_cart_block">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <p class="jeu-titre"><?=($donnees["jeu"]->getTitre())?></p>
                    <hr>
                    <?php if ($donnees["jeu"]->getLocation() == 0) { ?>
                        <h5 class="my-3">Jeu à vendre</h5>
                    <?php } else { ?>
                        <p class="date-form">
                            <div class="d-flex justify-content-between">
                                <h5 class="my-2">Dates de location&nbsp;:</h5>
                                <small class="my-2">Format&nbsp;: AAAA-MM-JJ au AAAA-MM-JJ</small>
                            </div>
                            <input style="width: 100%" type="text" id="datesLocation" name="datesLocation" class="form-control my-2" value="<?= isset($_SESSION["rechercher"]["datesLocation"]) ? $_SESSION["rechercher"]["datesLocation"] : (string)$date = date("Y-m-d") . " au " . (string)$date = date("Y-m-d") ?>">
                        </p>
                    <?php } ?>
                    <p class="lead">Prix : <?=($donnees["jeu"]->getPrix())?> <small>$CAD</small> <?= $donnees["jeu"]->getLocation() ? "par jour" : "" ?></p>
                    <p>Plateforme : <?= $donnees["plateforme"]->getPlateformeIcone() . " " . $donnees["plateforme"]->getPlateforme() ?></p>
                    <p>Concepteur : <?=($donnees["jeu"]->getConcepteur())?></p>
                    <p>Date d'ajout : <?=($donnees["jeu"]->getDateAjout())?></p>
                    <p>Catégorie<?= count($donnees['categoriesJeu']) > 1 ? "s" : "" ?> :
                    <?php for ($i = 0; $i < count($donnees['categoriesJeu']); $i++) {
                        if (count($donnees['categoriesJeu']) > 1 ) { ?>
                            <a><?= $donnees['categoriesJeu'][$i]->getCategorie() ?> <span class="cat-symbol"><i class="fas fa-angle-right"></i></span> </a>
                        <?php } else { ?>
                            <a><?= $donnees['categoriesJeu'][$i]->getCategorie() ?></a>
                        <?php }
                    } ?>
                    </p>
                    <p>Annonceur : <?=($donnees["membre"]->getPrenom()) . " " . ($donnees["membre"]->getNom())?></p>
                    <?php if (isset($_SESSION["type"]) && $_SESSION["type"] > 1) { ?>
                    <!-- Messagerie -->
                    <button type="button" id="button-contacter-annoceur" class="btn btn-outline-dark" data-toggle="collapse" data-target="#fcontact" aria-expanded="false" aria-controls="fcontact">Contacter l'annoceur <i class="fas fa-envelope"></i></button>
                    <input type="hidden" id="destinataire_id" value="<?=($donnees["membre"]->getMembreId())?>" />
                    <div id="fcontact" class="contacter-annoceur collapse mx-auto">
                        <div class="contacter-annoceur mx-auto">
                            <div>
                                <p><input name="sujet" id="sujet" type="text" size="22" tabindex="1" placeholder="Sujet... (*)" /></p>
                            </div>
                            <div>
                                <p><textarea name="message" id="message" cols="40" rows="4" tabindex="5" placeholder="Votre message... (*)"></textarea></p>
                            </div>
                            <p>
                                <div class="alert alert-danger hidden" role="alert">
                                    (*) Champs requis
                                </div>
                                <button id="envoyer-contacter">Envoyer Message <i class="fa fa-paper-plane"></i></button>
                            </p>
                        </div>
                    </div>
                    <script>
                        $( "#button-contacter-annoceur" ).click(function() {
                            if($("#membre_id").val() != ""){
                                //$( "#fcontact" ).show();   
                            }else{
                                bootoast.toast({
                                    message: 'seuls les membres inscrits peuvent contacter un autre membre!',
                                    type: 'warning',
                                    position: 'top-center'

                                    });
                                $("#envoyer-contacter").prop("disabled",true);
                            }
                        });
                        $( "#envoyer-contacter" ).click(function() {
                            if($("#sujet").val() == "" || $("#message").val() == ""){
                                $( ".alert" ).show(); 
                                $(".alert").alert();
                            }else{
                                $( ".alert" ).hide(); 
                                request = $.ajax({
                                url: "index.php?Messagerie&action=formAjoutMessage",
                                type: "post",
                                data: { 
                                    membre_id : $("#membre_id").val(),
                                    destinataire_id : $("#destinataire_id").val(),
                                    sujet : $("#sujet").val(),
                                    message : $("#message").val()
                                }
                            });
                            request.done(function (response, textStatus, jqXHR){
                                bootoast.toast({
                                    message: 'message envoyé correctement!',
                                    type: 'success',
                                    position: 'top-center'
                                    });
                                $( "#fcontact" ).hide(); 
                            });
                            }
                        });
                    </script>
                    <!-- Fin de messagerie -->
                    <?php } ?>
                    <div class="avis-etoiles p-3 mb-2 ">
                        <?= $donnees['nbEvaluations'][0] ?>&nbsp;avis&nbsp;
                        <?php if($donnees["jeu"]->getEvaluationGlobale() >= 0){ ?>
                            <span class="score"><span style="width: <?= ($donnees["jeu"]->getEvaluationGlobale() / 5) * 100 ?>%"></span></span>
                            (<?= round($donnees["jeu"]->getEvaluationGlobale(), 2) ?>&nbsp;/&nbsp;5)
                        <?php } else { ?>
                            <span>Jeu non évalué</span>
                        <?php } ?>
                        <a class="pull-right" href="#avis">Voir les avis</a>
                    </div>
                    <?php if(isset($_SESSION['id'])){
                        if($_SESSION['id'] == $donnees["jeu"]->getMembreId() || $_SESSION["type"] == 3 || $_SESSION["type"] == 4){ ?>
                        <a href="index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees["jeu"]->getJeuxId() ?>" class="btn btn-primary btn-lg btn-block text-uppercase text-white">Modifier ce jeu</a>
                        <?php } 
                        if(isset($_SESSION['id']) && $_SESSION['id'] != $donnees["jeu"]->getMembreId()){ ?>
                            <a id="ajouterPannier" class="btn btn-success btn-lg btn-block text-uppercase text-white" onclick="AjouterAuPanier('<?= $donnees['jeu']->getJeuxId() ?>')"><i class="fa fa-shopping-cart"></i> Ajouter au panier</a>
                        <?php } 
                    } else { ?>
                        <button class="btn btn-success btn-lg btn-block text-uppercase text-white" disabled><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
                        <p class="text-success text-center">Seuls les membres inscrits peuvent ajouter un jeu au panier!</p>
                    <?php } ?>
                </div>
            </div>          
        </div>
    </div>
    <div class="row">
        <!-- Description -->
        <div class="col-12">
            <div class="card border-light mb-3">
                <div class="card-header bg-secondary text-white text-uppercase"><i class="fa fa-align-justify"></i> Description du jeu</div>
                <div class="card-body">
                    <p class="card-text">
                        <?=($donnees["jeu"]->getDescription())?>
                    </p>
                </div>
            </div>
        </div>
        <!-- Avis -->
        <div class="col-12" id="avis">
            <div class="card border-light mb-3">
                <div class="card-header bg-secondary text-white text-uppercase"><i class="fa fa-comment"></i> Avis</div>
                <div class="card-body">
                    <div class="review">
                        <?php for ($i = 0; $i < count($donnees['evaluations'])-1; $i++) { ?>
                            <p><i class='fas fa-calendar-alt'></i>  <?= $donnees['evaluations'][$i]->getDateEvaluation() ?></p>
                            <p>Par : <?= $donnees['evaluations']['membres'][$i]->getPrenom() . " " . $donnees['evaluations']['membres'][$i]->getNom() ?></p>
                            <p><?= $donnees['evaluations'][$i]->getCommentaireJeu() ?></p>
                            <div class="col-6 text-center text-right my-3">
                                Évaluation&nbsp;:&nbsp;<?= round($donnees["evaluations"][$i]->getEvaluationJeu(), 2); ?>&nbsp;/&nbsp;5
                                <br><span class="score"><span style="width: <?= ($donnees["evaluations"][$i]->getEvaluationJeu() / 5) * 100 ?>%"></span></span>
                            </div>
                            <hr>
                        <?php } ?>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#ajouterPannier').click(function(){
        $('#cart').trigger('click.bs.dropdown');
    });
        

    $('#datesLocation').daterangepicker({
        "minYear": new Date().getFullYear(),
        <?= (isset($_SESSION['disponibilite']['dateDebut']) && strtotime($_SESSION['disponibilite']['dateDebut']) >= date("Y-m-d") ? '"minDate": "' . $_SESSION['disponibilite']['dateDebut'] . '", ' : '"minDate": new Date(), ') ?>
        
        "showDropdowns": true,
        "autoApply": true,
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
        "opens": "left",
    }, function(start, end, label) {
        console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });

    // $('#datesLocation').data('daterangepicker').setStartDate('03/01/2018');
    // $('#datesLocation').data('daterangepicker').setEndDate('03/31/2018');

    $("#datesLocation").click(function(){
        desactiverDatesCal();
    });

    $(".daterangepicker").mousemove(function(){
        desactiverDatesCal();
    });

    function desactiverDatesCal() {
        var nonDispos = <?= isset($donnees['nonDispos']) ? $donnees['nonDispos'] : "" ?>;
        // console.log(nonDispos);
        var cal1Year = Number($(".daterangepicker .left .yearselect").val());
        var cal1Month = Number($(".daterangepicker .left .monthselect").val()) + 1;
        var cal1Cells = $(".daterangepicker .left td");
        // console.log(cal1Year, cal1Month);
        // console.log(cal1Cells);
        var cal2Year = Number($(".daterangepicker .right .yearselect").val());
        var cal2Month = Number($(".daterangepicker .right .monthselect").val()) + 1;
        var cal2Cells = $(".daterangepicker .right td");
        // console.log(cal2Year, cal2Month);
        // console.log(cal2Cells);
        for (var i=0; i<nonDispos.length; i++) {
            var date = nonDispos[i].split("-");
            if (date[0] == cal1Year && date[1] == cal1Month) {
                for (var j=0; j<cal1Cells.length; j++) {
                    if (cal1Cells[j].innerHTML == Number(date[2])) {
                        cal1Cells[j].classList.remove("active", "start-date", "active", "end-date", "in-range", "available")
                        cal1Cells[j].classList.add("off", "disabled");
                    }
                }
            }
            if (date[0] == cal2Year && date[1] == cal2Month) {
                for (var j=0; j<cal2Cells.length; j++) {
                    if (cal2Cells[j].innerHTML == Number(date[2])) {
                        cal2Cells[j].classList.remove("active", "start-date", "active", "end-date", "in-range", "available")
                        cal2Cells[j].classList.add("off", "disabled");
                    }
                }
            }
        }
    }

    // Enlève le dernier " > " qui sépare les différentes catégories d'un jeu dans la page "jeux.php"
    let catDiv = document.getElementsByClassName("cat-symbol");  // Trouve le span qui contient l'icone " > " qui sépare les catégories
    let catDiv2 = (catDiv.length -1);                            // Declare la variable carDiv2 qui contient l'index du dernier élément du HTML Collection "catDiv"
    catDiv[catDiv2].style.display = "none";                      // Cache le dernier élément du HTML Collection en utilisant "display = none"

</script>

