<?php
/**
 * @file      ajoutJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Fichier de vue pour l'ajout de jeu
 * @details   Cette vue permettre l'insertion de nouveaux jeux dans la BD
 */
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1 class="jeu-titre">Ajouter un jeux</h1>
                    <?php
                    echo '<pre>';
                    var_dump($donnees['plateforme']);
                    echo '</pre>';
                    
                    ?>
                    <form action="index.php?Jeux&action=enregistrerJeuxJeux" method="POST">
                        <div class="form-group">
                            <label>Type de plateforme</label>
                            <select class="form-control" name="plateforme_id">
                                <?php
                                for($i = 0; $i < count($donnees['plateforme']); $i++)
                                {
                                    echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "'>" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                                }
                                ?>
                            </select>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
