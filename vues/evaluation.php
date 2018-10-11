<?php
/**
 * @file      ajoutJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Octobre 2018
 * @brief     Fichier de vue pour l'ajout de un'évaluation 
 * @details   Cette vue permettre l'insertion des évaluations a chaque jeux dans la BD
 */
?>
<div class="container">
    <div class="d-flex-row justify-content-between">
        <h1>Évaluation</h1>
        <form action="">
        <hr>
        <div class="form-group row">
            <div class="col-lg-4">
                <label>Description :</label>
                <textarea name="description" rows="8" cols="60"><?=$description?></textarea>
            </div> 
        </div>
        <hr>
        
        </form>
    </div>
</div>