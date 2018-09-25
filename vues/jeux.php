<!--/**-->
<!-- * @file      jeux.php-->
<!-- * @author    Guilherme Tosin, Marcelo Guzmán-->
<!-- * @version   1.0.0-->
<!-- * @date      Septembre 2018-->
<!-- * @brief     Fichier de vue pour les jeux.-->
<!-- * @details   Cette vue permettre voir les détails de chaque jeux-->
<!-- */-->

<div class="container pt-3">
    <div class="row">
        <!-- Image principale du jeu -->
        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <div id="carouselImagesJeu" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            for($i = 0; $i < count($donnees['images']); $i++)
                            {
                                if($i == 0)
                                {
                                    echo "<li data-target='#carouselImagesJeu' data-slide-to='" . $i . "' class='active'></li>";
                                }
                                else
                                {
                                    echo "<li data-target='#carouselImagesJeu' data-slide-to='" . $i . "'></li>";
                                }
                            }
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            for($i = 0; $i < count($donnees['images']); $i++)
                            {
                                if($i == 0)
                                {
                                    echo '<div class="carousel-item active">';
                                }
                                else
                                {
                                    echo '<div class="carousel-item">';
                                }
                                echo '<img class="d-block w-100" src="' . $donnees['images'][$i]->getCheminPhoto() . '" alt="' . $donnees["jeu"]->getTitre() . '">';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselImagesJeu" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselImagesJeu" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
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
                    <form>
                        <p>Négotiation : <?=($donnees["jeu"]->getLocation() == 1 ? "Location" : "À vendre") ?></p>
                        <p>Plateforme(s) : <?=($donnees["plateforme"]->getPlateforme())?></p>
                        <p>Concepteur : <?=($donnees["jeu"]->getConcepteur())?></p>
                        <p>Date de ajout : <?=($donnees["jeu"]->getDateAjout())?></p>
                        <p>Annonceur : <?=($donnees["membre"]->getPrenom()) . " " . ($donnees["membre"]->getNom())?></p>
                        <p>Catégories :</p>
                        <?php
                            for($i = 0; $i < count($donnees['categoriesJeu']); $i++)
                            {
                                echo '<p>' ."-" . $donnees['categoriesJeu'][$i]->getCategorie() .'</p>';
                                        
                            }
                        ?>
                        <p class="lead">Prix : <?=($donnees["jeu"]->getPrix())?> $CAD</p>
                    </form>
                    <div class="contacter-annoceur">
                        <i class="fa fa-phone fa-2x"></i><br/>Contacter annonceur
                    </div>

                    <div class="avis-etoiles p-3 mb-2 ">
                        4 avis
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        (4/5)
                        <a class="pull-right" href="#avis">Voir les avis</a>
                    </div>
                    <a class="btn btn-success btn-lg btn-block text-uppercase text-white">
                        <i class="fa fa-shopping-cart"></i> Ajouter au panier
                    </a>
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
                        Vestibulum quis blandit arcu. Nulla tristique tristique facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam vel aliquet risus, quis semper nulla. Suspendisse eleifend consequat enim, et accumsan dui consequat vitae. Duis at risus non turpis fringilla consequat vitae commodo enim. Curabitur nibh nulla, pharetra vel porta mollis, bibendum et nibh. Morbi et odio lorem. Maecenas est enim, mollis sed fringilla vel, faucibus sed metus. Mauris ornare faucibus augue sit amet dignissim. Maecenas bibendum, orci a elementum mattis, purus nulla elementum tortor, nec tincidunt nibh diam eu elit. Sed tortor nisi, tincidunt vel vestibulum ut, rhoncus vitae nibh. Pellentesque tempus, ligula in semper condimentum, tortor velit efficitur erat, non sodales purus mi eget sapien. Duis ipsum ex, faucibus aliquam dui et, fermentum cursus nisl. Maecenas convallis consectetur enim, nec mollis urna aliquam a.
                    </p>
                    <p class="card-text">
                        Sed dictum tortor at cursus iaculis. Vestibulum lacinia, ante vel tincidunt laoreet, leo mauris tempus velit, sed ornare mauris lacus sit amet leo. Sed eget ante vitae ex luctus dictum. In vel dapibus ex. Proin vehicula maximus blandit. Cras rhoncus metus ipsum, sit amet iaculis ex aliquam non. Quisque nec mauris consectetur, faucibus turpis ac, egestas libero. Nulla ornare leo elementum, faucibus nibh vitae, aliquet libero. Ut vestibulum nunc tortor. Maecenas in felis ultrices turpis pharetra luctus id ac mauris.
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
                        <i class="fas fa-calendar-alt"></i>
                        Janvier 15, 2018
                        <p class="pt-3">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span> par Mario Tardelli
                        </p>
                        <p>Aenean sollicitudin urna lacus, quis porttitor lacus eleifend sed. Sed rhoncus tellus vel leo placerat placerat. Vivamus at varius nisl. Nullam lobortis sagittis aliquam. Aliquam mattis vitae dolor quis porta. In varius urna lobortis porttitor lacinia. Integer id venenatis felis.</p>
                        <hr>
                    </div>
                    <div class="review">
                        <i class="fas fa-calendar-alt"></i>
                        Juillet 19, 2018
                        <p class="pt-3">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span> par Luigi Corleone
                        </p>
                        <p>Aenean sollicitudin urna lacus, quis porttitor lacus eleifend sed. Sed rhoncus tellus vel leo placerat placerat. Vivamus at varius nisl. Nullam lobortis sagittis aliquam. Aliquam mattis vitae dolor quis porta. In varius urna lobortis porttitor lacinia. Integer id venenatis felis.</p>
                        <hr>
                    </div>
                    <div class="review">
                        <i class="fas fa-calendar-alt"></i>
                        Septembre 10, 2018
                        <p class="pt-3">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span> par M. Sirois
                        </p>
                        <p>Aenean sollicitudin urna lacus, quis porttitor lacus eleifend sed. Sed rhoncus tellus vel leo placerat placerat. Vivamus at varius nisl. Nullam lobortis sagittis aliquam. Aliquam mattis vitae dolor quis porta. In varius urna lobortis porttitor lacinia. Integer id venenatis felis.</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
