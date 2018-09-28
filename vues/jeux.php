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
                        <a>Plateforme(s) :</a>
                        <?php

                            if ($donnees["plateforme"]->getPlateforme() == "Windows" ) {
                                echo '<i title="Windows" class="fab fa-windows"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Xbox One" ) {
                                echo '<i title="Xbox One" class="fab fa-xbox"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Xbox 360" ) {
                                echo '<i title="Xbox 360" class="fab fa-xbox"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Playstation 4" ) {
                                echo '<i title="Playstation 4" class="fab fa-playstation"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Playstation Vita" ) {
                                echo '<i title="Playstation Vita" class="fab fa-playstation"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Playstation 3" ) {
                                echo '<i title="Playstation 3" class="fab fa-playstation"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Nintendo Wii U" ) {
                                echo '<i title="Nintendo Wii U" class="fab fa-nintendo-switch"></i>';
                            }
                            else if ($donnees["plateforme"]->getPlateforme() == "Nintendo Switch" ) {
                                echo '<i title="Nintendo Switch" class="fab fa-nintendo-switch"></i>';
                            }
                        ?>
                        <br><br>
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
                    <!-- Mensagerie -->
                                <div class="contacter-annoceur mx-auto">
                                    <a>Contacter annonceur</a> <i class="far fa-comments fa-2x"></i>
                <div id="fcontacto">
                <!-- bloc de confirmation de envoy caché  -->
                <div id="c_information" class="hide">
                    <p></p>
                </div>
                <!-- Fin de confirmation de l'envoi -->
                <br>

                <!-- debut de formulario -->
                <form id="c_form" name="contact">
                    <div>
                        <p>
                            <input name="nom" id="c_name" type="text" size="22" tabindex="1" placeholder="votre nom... (*)" />
                        </p>
                        <p>
                            <input name="email" id="c_mail" type="email" size="22" tabindex="2" placeholder="votre email... (*)" />
                        </p>
                        <p>
                            <input name="telephonr" id="c_telephone" type="number" size="22" tabindex="4" placeholder="votre téléphone..." />
                        </p>
                        
                    </div>
                    <div>
                        <p>
                            <textarea name="message" id="c_msg" cols="40" rows="8" tabindex="5" placeholder="votre message... (*)"></textarea>
                        </p>
                    </div>
                    <div id="spam">
                        <label>Laissez ce champ vide</label>
                        <input type="text" id="c_spam_textbox1" name="spam_textoblanco" />
                        <label>Ne change pas cela</label>
                        <input type="text" id="c_spam_textbox2" value="http://" name="spam_webvacia" />
                    </div>
                    <p>
                        <label>(*) Champs requis</label>
                        <input name="cenvoyer" type="button" id="c_envoyer" tabindex="6" value="Envoyer Message" onclick="cargaSendMail()" />
                    </p>

                </form>
                <!-- fin de formulario -->

                </div>
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
                        <?php
                            for($i = 0; $i < count($donnees['commentaires'])-1; $i++)
                            {
                                echo "<p>" ."<i class='fas fa-calendar-alt'></i>  ". $donnees['commentaires'][$i]->getDateCommentaire() . "</p>";  
                                echo "<p>" ."Par : " .$donnees['commentaires']['membres'][$i]->getPrenom() ." " .$donnees['commentaires']['membres'][$i]->getNom() . "</p>"; 
                                echo "<p>" . $donnees['commentaires'][$i]->getCommentaire() . "</p>";
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

<!--Debut du Mesenger -->
<?php

if(isset($_POST['cenvoyer'])){


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
else die("L'accès direct à ce fichier n'est pas autorisé.");

    
    
?>


