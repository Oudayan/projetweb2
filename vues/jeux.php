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
                        <a>Catégories :</a>
                        <?php
                            for($i = 0; $i < count($donnees['categoriesJeu']); $i++)
                            {
                                if (count($donnees['categoriesJeu']) > 1 ) {
                                    echo '<a>' . $donnees['categoriesJeu'][$i]->getCategorie() .' <span class="cat-symbol"><i class="fas fa-angle-right"></i></span> </a>';
                                }
                                else {
                                    echo '<a>' . $donnees['categoriesJeu'][$i]->getCategorie() .'</a>';
                                }
                            }
                        ?>
                        <br /><br />
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
    <!-- <?php
        echo "<pre>";
        var_dump($donnees);
        echo "</pre>";
    ?> -->
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
                        <!-- <i class="fas fa-calendar-alt"></i>
                        Janvier 15, 2018 -->
                        <!-- <p class="pt-3">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span> par Mario Tardelli
                        </p> -->
                        <?php
                            for($i = 0; $i < count($donnees['commentaireJeu']); $i++)
                            {  
                                echo "<p>" ."Par : " .$donnees['commentaireJeu'][$i]->prenom ." " .$donnees['commentaireJeu'][$i]->nom . "</p>"; 
                                echo "<p>" . $donnees['commentaireJeu'][$i]->getCommentaire() . "</p>";
                                // echo "<p>" ."Evaluation : ". $donnees['commentaireJeu'][$i]->getEvaluation() ."</p>";
                                echo "<hr>";
                            }
                        ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // Enlève le dernier " > " qui sépare les différentes catégories d'un jeu dans la page "jeux.php"

    let catDiv = document.getElementsByClassName("cat-symbol");  // Trouve le span qui contient l'icone " > " qui sépare les catégories
    let catDiv2 = (catDiv.length -1);                            // Declare la variable carDiv2 qui contient l'index du dernier élément du HTML Collection "catDiv"
    catDiv[catDiv2].style.display = "none";                      // Cache le dernier élément du HTML Collection en utilisant "display = none"

</script>


