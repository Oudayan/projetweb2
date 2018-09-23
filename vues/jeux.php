<?php
/**
 * @file      jeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Fichier de vue pour les jeux.
 * @details   Cette vue permettre voir les détails de chaque jeux
 */
?>
<div class="container">
    <h1 class="text-center my-4"><?= $donnees["jeu"]->getTitre() ?></h1>
    <section>
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
    </section>
    <hr class= my-5>
    <section>
        <div class="row my-5">
            <div class="col-6">
                <h4>Prix :</h4>
                <span><strong><?=($donnees["jeu"]->getPrix())?>&nbsp;$</strong></span><span><small>&nbsp;<?=($donnees["jeu"]->getLocation() == 1 ? "location" : "à vendre") ?></small></span>                  
            </div>
            <div class="col-6 text-right">
                <h4>Propriétaire : </h4>
                <span><?=($donnees["membre"]->getPrenom()) . " " . ($donnees["membre"]->getNom())?></span>
            </div> 
        </div>
        <div class="row my-5">
            <div class="col-6">
                <h4>Concepteur :</h4>
                <span><?=($donnees["jeu"]->getConcepteur())?></span>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-6">
                <h4>Plateforme :</h4>
                <span><?=($donnees["plateforme"]->getPlateforme())?></span>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-6">
                <h4>Disponible depuis :</h4>
                <span><?=($donnees["jeu"]->getDateAjout())?></span>
            </div>
        </div>
    </section>
</div>