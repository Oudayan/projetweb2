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
                <h1 class="my-3 jeu-titre">Ajouter un jeu</h1>
            </div>
            
            <?php
            // echo '<pre>';
            // var_dump($donnees['plateforme']);
            // var_dump($donnees['jeu']);
            // var_dump($donnees['categories']);
            // echo '</pre>';
            $membre_id = $_SESSION['id'];
            $date_ajout = date("Y-m-d H:i");
            ?>
            <form action="index.php?Jeux&action=enregistrerJeux" method="POST">
                <input type="hidden" name="membre_id" id="membre_id" value="<?=$membre_id?>">
                <input type="hidden" name="date_ajout" id="date_ajout" value="<?=$date_ajout?>">
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
                            <input type="radio" id="louer" 
                            name="jeu_a" value="louer" checked />
                            <label for="louer">Louer </label>
                        </div>
                        <div>
                            <input type="radio" id="vendre" 
                            name="jeu_a" value="vendre" checked />
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
                                echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "'>" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                            }
                            ?>
                        </select>
                    </div>  
                </div>
                <hr>
                <div class="form-group row">
                    <div class="d-flex flex-wrap justify-content-between">
                        <?php
                            for($i = 0; $i < count($donnees['categories']); $i++)
                            {
                                echo "<div class='col-lg-6'>";
                                    echo "<input type='checkbox' name='categorie1' value=" . $donnees['categories'][$i]->getCategorieId() .">";
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
                        <textarea rows="8" cols="60"></textarea>
                    </div> 
                </div>
                <hr>
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

