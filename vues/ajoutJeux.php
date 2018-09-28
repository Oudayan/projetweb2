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
                    <form action="index.php?Jeux&action=enregistrerJeuxJeux" method="POST">
                        <div class="form-group">
                            <label>Type de plateforme</label>
                            <select name="form-control" id="plateforme_id">
                            <?php
                            echo '<pre>';
                            var_dump($donnees['plateforme']);
                            echo '</pre>';
                            // foreach($donness[])
                            ?>
                            </select>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
