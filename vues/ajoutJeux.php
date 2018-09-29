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
?>
    <div class="container">
        <div class="d-flex-row justify-content-between">
            <div class="d-flex justify-content-center">
                <h1 class="my-3 jeu-titre">Ajouter un jeux</h1>
            </div>
            
            <!-- <?php
            echo '<pre>';
            var_dump($donnees['plateforme']);
            var_dump($donnees['jeu']);
            var_dump($donnees['categories']);
            echo '</pre>';
            ?> -->
            <form action="index.php?Jeux&action=enregistrerJeux" method="POST">
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="pwd">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre">
                        <input type="hidden" name="membre_id" id="membre_id" value="<?=$_SESSION['id']?>">
                        <input type="hidden" name="date_ajout" id="date_ajout" value="<?=date("Y-m-d H:i")?>">
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Prix :</label>
                        <input type="text" class="form-control" id="prix" name="prix">
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Concepteur :</label>
                        <input type="text" class="form-control" id="concepteur" name="concepteur">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <fieldset class="col-lg-4">
                        <legend>Vous voulez mettre votre jeu à :</legend>
                        <div>
                            <input type="radio" id="louer" 
                            name="drone" value="louer" checked />
                            <label for="louer">Louer </label>
                        </div>
                        <div>
                            <input type="radio" id="vendre" 
                            name="drone" value="vendre" checked />
                            <label for="vendre">À vendre</label>
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
                                echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "'>" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                            }
                            ?>
                        </select>
                    </div>  
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <?php
                            for($i = 0; $i < count($donnees['categories']); $i++)
                            {
                                echo "<input type='checkbox' name='categorie1' value='" . $donnees['categories'][$i]->getCategorieId() . "'>" . $donnees['categories'][$i]->getCategorie() . "<br>";

                            }
                        ?>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Description :</label>
                        <textarea rows="8" cols="60"></textarea>
                    </div> 
                </div>
                <hr>          
            </form>
        </div>
    </div>
<?php
}
else{
    echo "Vous n'avez pas la permission d'acceder à cette page";
}