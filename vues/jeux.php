<!--/**-->
<!-- * @file      jeux.php-->
<!-- * @author    Guilherme Tosin, Marcelo Guzmán-->
<!-- * @version   1.0.0-->
<!-- * @date      Septembre 2018-->
<!-- * @brief     Fichier de vue pour les jeux.-->
<!-- * @details   Cette vue permettre voir les détails de chaque jeux-->
<input type="hidden" id="membre_id" value="<?= isset($_SESSION["id"]) ? $_SESSION["id"] : ""?>"/>
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
                        <p>Négotiation : <?=($donnees["jeu"]->getLocation() == 1 ? "Location" : "À vendre") ?></p>
                        <a>Plateforme(s) :</a>
                        <?php

                            if ($donnees["plateforme"]->getPlateforme() == "Windows" ) {
                                echo '<i title="Windows" class="fab fa-windows"></i> Windows';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Xbox One" ) {
                                echo '<i title="Xbox One" class="fab fa-xbox"></i> Xbox One';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Xbox 360" ) {
                                echo '<i title="Xbox 360" class="fab fa-xbox"></i> Xbox 360';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Playstation 4" ) {
                                echo '<i title="Playstation 4" class="fab fa-playstation"></i> Playstation 4';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Playstation Vita" ) {
                                echo '<i title="Playstation Vita" class="fab fa-playstation"></i> Playstation Vita';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Playstation 3" ) {
                                echo '<i title="Playstation 3" class="fab fa-playstation"></i> Playstation 3';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Nintendo Wii U" ) {
                                echo '<i title="Nintendo Wii U" class="fab fa-nintendo-switch"></i> Nintendo Wii U';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Nintendo Switch" ) {
                                echo '<i title="Nintendo Switch" class="fab fa-nintendo-switch"></i> Nintendo Switch';
                            }
                        ?>
                        <br><br>
                        <p>Concepteur : <?=($donnees["jeu"]->getConcepteur())?></p>
                        <p>Date de ajout : <?=($donnees["jeu"]->getDateAjout())?></p>
                        <p>Annonceur : <?=($donnees["membre"]->getPrenom()) . " " . ($donnees["membre"]->getNom())?></p>
                        <input type="hidden" id="destinataire_id" value="<?=($donnees["membre"]->getMembreId())?>" />
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
                    <!-- fin de formulario -->
                    <!-- Mensagerie -->
                    <button id="button-contacter-annoceur">Contacter annoceur <i class="fas fa-envelope"></i></button>
                    <div id="fcontacto" class="contacter-annoceur mx-auto hidden">
                        <div class="contacter-annoceur mx-auto">
                            <div>
                                <p>
                                    <input name="sujet" id="sujet" type="text" size="22" tabindex="1" placeholder="Subjet... (*)" />
                                </p>
                            </div>
                            <div>
                                <p>
                                    <textarea name="message" id="message" cols="40" rows="4" tabindex="5" placeholder="votre message... (*)"></textarea>
                                </p>
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
                                $( "#fcontacto" ).show();   
                            }else{
                                bootoast.toast({
                                    message: 'seuls les membres inscrits peuvent contacter un autre membre!',
                                    type: 'warning',
                                    position: 'top-center'
                                    });
                            }
                        });
                        $( "#envoyer-contacter" ).click(function() {
                            if($("#sujet").val() == "" || $("#message").val() == ""){
                                $( ".alert" ).show(); 
                                $(".alert").alert();
                            }else{
                                $( ".alert" ).hide(); 
                                request = $.ajax({
                                url: "index.php?messagerie&action=formAjoutMessage",
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
                                $( "#fcontacto" ).hide(); 
                            });
                            }
                        });
                    </script>
                <!-- fin de formulario -->
                    <div class="avis-etoiles p-3 mb-2 ">
                        <span><?= $donnees['nbCommentaires'][0] ?> avis</span>
                        <!-- <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i> -->
                        <?php if($donnees["jeu"]->getEvaluationGlobale() >= 0) { ?>
                            <span class="score"><span style="width: <?= ($donnees["jeu"]->getEvaluationGlobale() / 5) * 100 ?>%"></span></span>
                            (<?= round($donnees["jeu"]->getEvaluationGlobale(), 2); ?>&nbsp;/&nbsp;5) 
                        <?php } else { ?>
                            <span class="text-muted"> Jeu non évalué </span>
                        <?php } ?>
                        <a class="pull-right" href="#avis"> Voir les avis </a>
                    </div>
                    <?php if(isset($_SESSION['id']) && $_SESSION['id'] != $donnees["jeu"]->getMembreId()){ ?>
                        <!-- Mensagerie -->
                        <!-- <div class="contacter-annoceur mx-auto">
                            <a href="index.php?Messagerie&action=afficherMessagerie">Contacter annonceur</a> <i class="far fa-comments fa-2x"></i>
                        </div> -->
                        <a class="btn btn-success btn-lg btn-block text-uppercase text-white">
                            <i class="fa fa-shopping-cart"></i> Ajouter au panier
                        </a>
                    <?php } else{ ?>
                        <a href="index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees["jeu"]->getJeuxId() ?>" class="btn btn-primary btn-lg btn-block text-uppercase text-white">Modifier ce jeu</a>
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
                        <?php for($i = 0; $i < count($donnees['commentaires'])-1; $i++) { ?>
                            <p><i class='fas fa-calendar-alt'></i> <?= $donnees['commentaires'][$i]->getDateCommentaire() ?></p>
                            <p>Par : <?= $donnees['commentaires']['membres'][$i]->getPrenom() . " " .$donnees['commentaires']['membres'][$i]->getNom() ?></p>
                            <p><?= $donnees['commentaires'][$i]->getCommentaire() ?></p>
                            <div class="col-6">
                                Évaluation&nbsp;:&nbsp;<?= round($donnees["commentaires"][$i]->getEvaluation(), 2); ?>&nbsp;/&nbsp;5
                                <br><span class="score"><span style="width: <?= ($donnees["commentaires"][$i]->getEvaluation() / 5) * 100 ?>%"></span></span>
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

    // Enlève le dernier " > " qui sépare les différentes catégories d'un jeu dans la page "jeux.php"

    let catDiv = document.getElementsByClassName("cat-symbol");  // Trouve le span qui contient l'icone " > " qui sépare les catégories
    let catDiv2 = (catDiv.length -1);                            // Declare la variable carDiv2 qui contient l'index du dernier élément du HTML Collection "catDiv"
    catDiv[catDiv2].style.display = "none";                      // Cache le dernier élément du HTML Collection en utilisant "display = none"

</script>

<!--Debut du Mesenger -->
<?php

if(isset($_POST['c_envoyer'])){


    if(isset($_POST['nom'])){
        $nom = $_POST['nom'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['telephone'])){
        $telephone = $_POST['telephone'];
    }
    if(isset($_POST['messenger'])){
        $messenger = $_POST['messenger'];
    }
    // Si quelque ligne a plus de 70 caracteres
    $messenger = wordwrap($messenger, 70, "\r\n");



    $msj = "De: ".$nom."\r\n";
    $msj .= "Email: ".$email."\r\n";
    $msj .= "Date: ".date("d-m-Y H:i:s")."\r\n";
    $msj .= "Telephone: ".$telephone."\r\n\n\n\n";
    $msj .= "Messenger: ".$messenger;


    /***** Envoy avec la function MAIL de php *****/
      
    mail('jansylopez@gmail.com', 'Sujeto:Testing le Formulaire de contact...', $msj);

}
//else die("L'accès direct à ce fichier n'est pas autorisé.");

    
    
?>


