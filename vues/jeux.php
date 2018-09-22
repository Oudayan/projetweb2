<?php
echo '<pre>';
var_dump($donnees);
// var_dump($donnees['images']);
echo '</pre>';

?>
<h1><?= $donnees["jeux"]->getTitre() ?></h1>


<div id="carouselImagesJeu" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php 
    for($i = 0; $i < count($donnees['images']); $i++)
    {
        if($i == 0)
        {
            echo "<li data-target='carouselImagesJeu' data-slide-to='" . $i . "' class='active'></li>";
        }
        else
        {
            echo "<li data-target='carouselImagesJeu' data-slide-to='" . $i . "'></li>";
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
            echo '<img class="d-block w-100" src="' . $donnees['images'][$i]->getCheminPhoto() . '" alt="' . $donnees["jeux"]->getTitre() . '">';
            echo '</div>';            
        }
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>