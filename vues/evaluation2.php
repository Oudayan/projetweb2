<?php
/**
 * @file      ajoutJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Octobre 2018
 * @brief     Fichier de vue pour l'ajout d'une évaluation 
 * @details   Cette vue permettre l'insertion des évaluations a chaque jeux dans la BD
 */
?>
<div class="container">
<?php if ($donnees["erreur"] == "") { ?>
    <div class="d-flex justify-content-around mt-3">
        <h1 class="text-center">Évaluation du jeu <?= $donnees["jeu"]->getTitre(); ?></h1>
        <?php if ($donnees["jeu"]->getLocation()) { ?>
            <h2>Location du&nbsp;<?= $donnees["location"]->getDateDebut() ?> au&nbsp;<?= $donnees["location"]->getDateRetour() ?></h2>
        <?php } else { ?>
            <h2>Acheté le&nbsp;<?= $donnees["achat"]->getDateAchat() ?></h2>
        <?php } ?>
    </div>
    <div class="d-flex justify-content-around mt-3">
        <h2>Cette évaluation sera fermée et compilée le <?= $donnees["dateLimite"] ?> à minuit</h2>
    </div>
    <section class="py-5">
        <form method="POST" action="index.php?Evaluation">
            <input type="hidden" name="action" value="sauvegarderEvaluation">
            <input type="hidden" name="idLocation" value="<?= $donnees["location"]->getIdLocation() ?>">
            <input type="hidden" name="jeton" value="<?= (isset($donnees['jeton']) ? $donnees['jeton'] : "") ?>">
            <div class="form-group">
                <label for="evaluation">Évaluation sur 5 étoiles&nbsp;:</label>
                <select class="form-control" id="evaluation" name="evaluation">
                    <option value="0" <?= ($donnees["location"]->getEvaluation() == 0 || $donnees["location"]->getEvaluation() == NULL ? 'selected' : ''); ?>>Aucune étoile</option>
                    <option value="0.5" <?= ($donnees["location"]->getEvaluation() == 0.5 ? 'selected' : ''); ?>>Une demie étoile</option>
                    <option value="1" <?= ($donnees["location"]->getEvaluation() == 1 ? 'selected' : ''); ?>>1 étoile</option>
                    <option value="1.5" <?= ($donnees["location"]->getEvaluation() == 1.5 ? 'selected' : ''); ?>>1 étoile et demie</option>
                    <option value="2" <?= ($donnees["location"]->getEvaluation() == 2 ? 'selected' : ''); ?>>2 étoiles</option>
                    <option value="2.5" <?= ($donnees["location"]->getEvaluation() == 2.5 ? 'selected' : ''); ?>>2 étoiles et demie</option>
                    <option value="3" <?= ($donnees["location"]->getEvaluation() == 3 ? 'selected' : ''); ?>>3 étoiles</option>
                    <option value="3.5" <?= ($donnees["location"]->getEvaluation() == 3.5 ? 'selected' : ''); ?>>3 étoiles et demie</option>
                    <option value="4" <?= ($donnees["location"]->getEvaluation() == 4 ? 'selected' : ''); ?>>4 étoiles</option>
                    <option value="4.5" <?= ($donnees["location"]->getEvaluation() == 4.5 ? 'selected' : ''); ?>>4 étoiles et demie</option>
                    <option value="5" <?= ($donnees["location"]->getEvaluation() == 5 ? 'selected' : ''); ?>>5 étoiles</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description de votre expérience et commentaires&nbsp;:</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="10" ><?= $donnees["location"]->getCommentaire() ?></textarea>
            </div>
            <button type="submit" class="btn btn-orange">Soumettre</button>
        </form>
    </section>
    <section class="d-flex justify-content-around mt-3">
        <h3 class="text-center text-danger m-3"><?= (isset($donnees["succes"]) ? $donnees["succes"] : "") ?></h3>
    </section>
<?php }
    else { ?>
        <div class="d-flex justify-content-around mt-3">
            <h1 class="text-center">Évaluation d'un jeu</h1>
        </div>
        <section class="my-5 py-5">
            <h3 class="text-center m-3"><?= $donnees["erreur"] ?></h3>
        </section>
<?php } ?>
</div>