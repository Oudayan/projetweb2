<?php
/**
 * @file      ajoutJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Fichier de vue pour l'ajout de jeu
 * @details   Cette vue permettre l'insertion de nouveaux jeux dans la BD
 */

if(isset($_SESSION['id']))
{

    if(isset($donnees['jeu']))
    {
        $titre = $donnees['jeu']->getTitre();
        $prix = $donnees['jeu']->getPrix();
        $concepteur = $donnees['jeu']->getConcepteur();
        if($donnees['jeu']->getLocation()){
            $location = "checked";
            $vendre = "";
        }
        else
        {
            $location = "";
            $vendre = "checked"; 
        } 
        $plateforme_id = $donnees['jeu']->getPlateformeId();
        $description = $donnees['jeu']->getDescription();

    }
    else
    {
        $titre = $prix = $concepteur = $location = $vendre = $plateforme_id = $description = "";
    }

    //var_dump($donnees['categoriesJeu']);
    for ($i = 0; $i < count($donnees['categories']); $i++)
    {
        $categorie[$i] = "";
        if (isset($donnees['categoriesJeu']))
        {
            for ($j = 0; $j < count($donnees['categoriesJeu']); $j++) {
                if ($donnees['categories'][$i]->getCategorieId() == $donnees['categoriesJeu'][$j]->getCategorieId()) {
                    $categorie[$i] = " checked";
                }
            }
            //var_dump($donnees['categoriesJeu'][$donnees['categoriesJeu'][$i]->getCategorieId()]);
        }
    }
    // var_dump($donnees['jeu']);
?>
    <div class="container">
        <div class="d-flex-row justify-content-between">
            <div class="d-flex justify-content-center">
                <h1 class="my-3 jeu-titre"><?=isset($donnees['jeu']) ? 'Modifier un jeu' : 'Ajouter un jeu'?></h1>
            </div>
            <form action="index.php?Jeux&action=enregistrerJeux" method="POST">
                <input type="hidden" name="jeux_id" id="jeux_id" value="<?= (isset($donnees['jeu']) ? $donnees['jeu']->getJeuxId() : 0) ?>">
                <input type="hidden" name="membre_id" id="membre_id" value="<?=$_SESSION['id']?>">
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="pwd">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?=$titre?>"> 
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Prix :</label>
                        <input type="text" class="form-control" id="prix" name="prix" value="<?=$prix?>">
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Concepteur :</label>
                        <input type="text" class="form-control" id="concepteur" name="concepteur" value="<?=$concepteur?>">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <fieldset class="col-lg-4">
                        <legend>Vous voulez mettre votre jeu à :</legend>
                        <div>
                            <input type="radio" id="louer" name="location" value="1" <?= $location ?>/>
                            <label for="louer">Louer </label>
                        </div>
                        <div>
                            <input type="radio" id="vendre" name="location" value="0" <?= $vendre ?>/>
                            <label for="vendre">Vendre</label>
                        </div>
                    </fieldset>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Type de plateforme</label>
                        <select class="form-control" name="plateforme_id">
                            <?php
                            for($i = 0; $i < count($donnees['plateforme']); $i++)
                            {
                                echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "' " . ($donnees['plateforme'][$i]->getPlateformeId() == $plateforme_id ? 'selected' : '') . ">" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                            }
                            ?>
                        </select>
                    </div>  
                </div>
                <hr>
                <div class="form-group row">
                    <label class="ml-3">Categories :</label>
                    <div class="d-flex flex-wrap justify-content-between">
                        
                        <?php
                            for($i = 0; $i < count($donnees['categories']); $i++)
                            {
                                echo "<div class='col-lg-6'>";
                                    echo "<input type='checkbox' name='categorie1' value='" . $donnees['categories'][$i]->getCategorieId() . "'" . $categorie[$i] . ">";
                                    echo "<label class='ml-2'>" . $donnees['categories'][$i]->getCategorie() . "</label><br>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Description :</label>
                        <textarea name="description" rows="8" cols="60"><?=$description?></textarea>
                    </div> 
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>File : </label>
                        <input type="file" name="image"/>
                        <input type="submit" class="ml-3"/>
                    </div> 
                </div>
                <div class="d-flex justify-content-around my-5">
                    <a href="index.php?Jeux&action=derniers"><button type="button" class="btn-lg btn-outline-dark">Annuler</button></a>
                    <input type="submit" class="btn btn-lg btn-outline-success" value="Sauvegarder">
                </div>          
            </form>
        </div>
    </div>
<?php
}
else{
    echo "Vous n'avez pas la permission d'acceder à cette page";
}
?>
<!-- <script>
$(document).on("click", "#annoce a", function(e){
    // e.preventDefault();
    $(this).addClass("invisible");
    // console.log(this);
});

</script> -->
