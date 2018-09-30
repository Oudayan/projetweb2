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
        <div class="row">
            <div class="col-12">
                <h1 class="jeu-titre">Ajouter un jeux</h1>
                <?php
                echo '<pre>';
                var_dump($donnees['plateforme']);
                var_dump($donnees['jeu']);
                var_dump($donnees['categories']);
                echo '</pre>';
                
                ?>
                <form action="index.php?Jeux&action=enregistrerJeuxJeux" method="POST">
                    <div>
                        <label>Type de plateforme</label>
                        <select class="form-control" name="plateforme_id">
                            <?php
                            for($i = 0; $i < count($donnees['plateforme']); $i++)
                            {
                                echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "'>" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                            }
                            ?>
                        </select>
                        
                        <?=$_SESSION['id']?>
                        <hr>
                        <div>
                            <label for="pwd">Titre :</label>
                            <input type="text" class="form-control" id="titre" name="titre">
                        </div>
                        <hr>
                        <div>
                            <label for="pwd">Prix :</label>
                            <input type="text" class="form-control" id="prix" name="prix">
                        </div>
                        <hr>
                        <?=date("Y-m-d H:i")?>
                        <div>
                            <label for="pwd">Concepteur :</label>
                            <input type="text" class="form-control" id="concepteur" name="concepteur">
                        </div>
                        <hr>
                        <div>
                            <fieldset>
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
                        <div>
                            <?php
                                for($i = 0; $i < count($donnees['categories']); $i++)
                                {
                                    echo "<input type='checkbox' name='categorie1' value='" . $donnees['categories'][$i]->getCategorieId() . "'>" . $donnees['categories'][$i]->getCategorie() . "<br>";
                                    
                                }
                            ?>
                        </div>
                        <hr>
                        <div>
                            <p>Description</p>
                            <textarea rows="8" cols="80"></textarea>
                        </div>
                        <hr>   
                    </div>       
                </form>
            </div>
        </div>
    </div>
<?php
}
else{
    echo "Vous n'avez pas la permission d'acceder à cette page";
}