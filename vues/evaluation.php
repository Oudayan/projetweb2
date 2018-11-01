<?php
/**
 * @file      evaluation.php
 * @author    Oudayan Dutta
 * @version   1.0.0
 * @date      Octobre 2018
 * @brief     Fichier de vue pour l'ajout d'un commenntaire et évaluation 
 * @details   Cette vue permet l'insertion des évaluations de chaque jeux dans la BD
 */
?>
            <div class="bg-evaluation text-white">
                <?php if (isset($donnees['admin'])) { ?>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn close" onclick="getPage(<?= $_SESSION['params']['page'] . ', ' . $_SESSION['params']['itemsParPage'] . ', \'' . $_SESSION['params']['tri'] . '\', ' . $_SESSION['params']['ordre']?>)"><h2>&times;</h2></button>
                </div>
                <?php } ?>
                <div class="container">
                    <div class="d-flex justify-content-around pt-5">
                        <h1> Commentaires et Évaluations</h1>
                    </div>
                    <div class="d-flex justify-content-around my-3">
                        <?php $dateLimite = $donnees["dateLimite"]->format('Y-m-d'); ?>
                        <h3>Cette évaluation sera fermée et compilée le <span class="text-danger"><?= $dateLimite ?></span> à minuit</h3>
                    </div>
                    <?php if ($donnees["erreur"] == "") { ?>
                        <div class="d-flex justify-content-around my-3">
                            <h4><?php echo $donnees["membre"]->getPrenom() . " " . $donnees["membre"]->getNom() . ", veuillez évaluer votre ";
                            if ($donnees["jeu"]->getLocation()) { 
                                $dateDebut = new DateTime($donnees["transaction"]->getDateDebut());
                                $dateDebut = $dateDebut->format('Y-m-d');
                                $dateRetour = new DateTime($donnees["transaction"]->getDateRetour());
                                $dateRetour = $dateRetour->format('Y-m-d');
                                echo "location du " . $dateDebut . " au " . $dateRetour; ?>
                            </h4>
                            <?php } else { 
                                $dateAchat = new DateTime($donnees["transaction"]->getDateAchat());
                                $dateAchat = $dateAchat->format('Y-m-d');
                                echo "achat du " . $dateAchat ?>
                            </h4>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <section class="col-lg-6 align-self-center p-4">
                                <form method="POST" action="index.php?Evaluation">
                                    <input type="hidden" name="action" value="sauvegarderEvaluation">
                                    <input type="hidden" name="jeton" value="<?= $donnees["evaluation"]->getJeton() ?>">
                                    <h5>Évaluation du jeu <?= $donnees["jeu"]->getTitre(); ?></h5>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="evaluationJeu" class="col-5 mt-3">Évaluation sur 5 étoiles&nbsp;:</label>
                                            <fieldset id="evaluationJeu" name="evaluationJeu" class="col rating">
                                                <input type="radio" id="jeu-star5" name="evaluationJeu" value="5" <?= ($donnees["evaluation"]->getEvaluationJeu() == 5 ? 'checked' : ''); ?>/><label class ="full" for="jeu-star5" title="5 étoiles"></label>
                                                <input type="radio" id="jeu-star4half" name="evaluationJeu" value="4.5" <?= ($donnees["evaluation"]->getEvaluationJeu() == 4.5 ? 'checked' : ''); ?>/><label class="half" for="jeu-star4half" title="4.5 étoiles"></label>
                                                <input type="radio" id="jeu-star4" name="evaluationJeu" value="4" <?= ($donnees["evaluation"]->getEvaluationJeu() == 4 ? 'checked' : ''); ?>/><label class ="full" for="jeu-star4" title="4 étoiles"></label>
                                                <input type="radio" id="jeu-star3half" name="evaluationJeu" value="3.5" <?= ($donnees["evaluation"]->getEvaluationJeu() == 3.5 ? 'checked' : ''); ?>/><label class="half" for="jeu-star3half" title="3.5 étoiles"></label>
                                                <input type="radio" id="jeu-star3" name="evaluationJeu" value="3" <?= ($donnees["evaluation"]->getEvaluationJeu() == 3 ? 'checked' : ''); ?>/><label class ="full" for="jeu-star3" title="3 étoiles"></label>
                                                <input type="radio" id="jeu-star2half" name="evaluationJeu" value="2.5" <?= ($donnees["evaluation"]->getEvaluationJeu() == 2.5 ? 'checked' : ''); ?>/><label class="half" for="jeu-star2half" title="2.5 étoiles"></label>
                                                <input type="radio" id="jeu-star2" name="evaluationJeu" value="2" <?= ($donnees["evaluation"]->getEvaluationJeu() == 2 ? 'checked' : ''); ?>/><label class ="full" for="jeu-star2" title="2 étoiles"></label>
                                                <input type="radio" id="jeu-star1half" name="evaluationJeu" value="1.5" <?= ($donnees["evaluation"]->getEvaluationJeu() == 1.5 ? 'checked' : ''); ?>/><label class="half" for="jeu-star1half" title="1.5 étoiles"></label>
                                                <input type="radio" id="jeu-star1" name="evaluationJeu" value="1" <?= ($donnees["evaluation"]->getEvaluationJeu() == 1 ? 'checked' : ''); ?>/><label class ="full" for="jeu-star1" title="1 étoile"></label>
                                                <input type="radio" id="jeu-starhalf" name="evaluationJeu" value="0.5" <?= ($donnees["evaluation"]->getEvaluationJeu() == 0.5 ? 'checked' : ''); ?>/><label class="half" for="jeu-starhalf" title="0.5 étoiles"></label>
                                                <input type="radio" id="jeu-star0" name="evaluationJeu" value="0" <?= ($donnees["evaluation"]->getEvaluationJeu() == 0 ? 'checked' : ''); ?>/>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaireJeu">Commentaires sur le jeu&nbsp;:</label>
                                        <textarea class="form-control" id="commentaireJeu" name="commentaireJeu" rows="5" ><?= $donnees["evaluation"]->getCommentaireJeu() ?></textarea>
                                    </div>
                                    <hr class="my-4">
                                    <h5>Évaluation du membre <?= $donnees["proprietaire"]->getPrenom() . " " . $donnees["proprietaire"]->getNom() ?></h5>
                                    <div class="form-group star-select">
                                        <div class="row">
                                            <label for="evaluationMembre" class="col-5 mt-3">Évaluation sur 5 étoiles&nbsp;:</label>
                                            <fieldset id="evaluationMembre" name="evaluationMembre" class="col rating">
                                                <input type="radio" id="membre-star5" name="evaluationMembre" value="5" <?= ($donnees["evaluation"]->getEvaluationMembre() == 5 ? 'checked' : ''); ?>/><label class ="full" for="membre-star5" title="5 étoiles"></label>
                                                <input type="radio" id="membre-star4half" name="evaluationMembre" value="4.5" <?= ($donnees["evaluation"]->getEvaluationMembre() == 4.5 ? 'checked' : ''); ?>/><label class="half" for="membre-star4half" title="4.5 étoiles"></label>
                                                <input type="radio" id="membre-star4" name="evaluationMembre" value="4" <?= ($donnees["evaluation"]->getEvaluationMembre() == 4 ? 'checked' : ''); ?>/><label class ="full" for="membre-star4" title="4 étoiles"></label>
                                                <input type="radio" id="membre-star3half" name="evaluationMembre" value="3.5" <?= ($donnees["evaluation"]->getEvaluationMembre() == 3.5 ? 'checked' : ''); ?>/><label class="half" for="membre-star3half" title="3.5 étoiles"></label>
                                                <input type="radio" id="membre-star3" name="evaluationMembre" value="3" <?= ($donnees["evaluation"]->getEvaluationMembre() == 3 ? 'checked' : ''); ?>/><label class ="full" for="membre-star3" title="3 étoiles"></label>
                                                <input type="radio" id="membre-star2half" name="evaluationMembre" value="2.5" <?= ($donnees["evaluation"]->getEvaluationMembre() == 2.5 ? 'checked' : ''); ?>/><label class="half" for="membre-star2half" title="2.5 étoiles"></label>
                                                <input type="radio" id="membre-star2" name="evaluationMembre" value="2" <?= ($donnees["evaluation"]->getEvaluationMembre() == 2 ? 'checked' : ''); ?>/><label class ="full" for="membre-star2" title="2 étoiles"></label>
                                                <input type="radio" id="membre-star1half" name="evaluationMembre" value="1.5" <?= ($donnees["evaluation"]->getEvaluationMembre() == 1.5 ? 'checked' : ''); ?>/><label class="half" for="membre-star1half" title="1.5 étoiles"></label>
                                                <input type="radio" id="membre-star1" name="evaluationMembre" value="1" <?= ($donnees["evaluation"]->getEvaluationMembre() == 1 ? 'checked' : ''); ?>/><label class ="full" for="membre-star1" title="1 étoile"></label>
                                                <input type="radio" id="membre-starhalf" name="evaluationMembre" value="0.5" <?= ($donnees["evaluation"]->getEvaluationMembre() == 0.5 ? 'checked' : ''); ?>/><label class="half" for="membre-starhalf" title="0.5 étoiles"></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaireMembre">Commentaires sur le membre&nbsp;:</label>
                                        <textarea class="form-control" id="commentaireMembre" name="commentaireMembre" rows="5" ><?= $donnees["evaluation"]->getCommentaireMembre() ?></textarea>
                                    </div>
                                    <hr>
                                    <?php if (!isset($donnees["admin"])) { ?>
                                    <div class="d-flex justify-content-around m-3">
                                        <a href="index.php?Messagerie&action=afficherMessagerie" class="btn btn-secondary">Annuler</a>
                                        <button type="submit" class="btn btn-success">Soumettre</button>
                                    </div>
                                    <?php } ?>
                                </form>
                                <?php if (isset($donnees["admin"])) {
                                    if (isset($_SESSION['params'])) { ?>
                                    <button class="btn btn-secondary btn-lg mt-4" onclick="getPage(<?= $_SESSION['params']['page'] . ', ' . $_SESSION['params']['itemsParPage'] . ', \'' . $_SESSION['params']['tri'] . '\', ' . $_SESSION['params']['ordre']?>)">Annuler</button>
                                    <?php } ?>
                                    <button class="btn btn-success btn-lg mt-4" id="btnValidation" onclick="sauvegarderMembre()" disabled>Modifier</button>
                                <?php } ?>
                                <hr>
                            </section>
                            <section class="col-lg-6 p-4 my-5">
                                <div id="carouselEvaluation" class="carousel slide" data-ride="carousel" data-interval="3000">
                                    <?php if (count($donnees['images']) > 1) { ?>
                                        <ol class="carousel-indicators">
                                        <?php for ($i = 0; $i < count($donnees['images']); $i++) {
                                            if ($i == 0) { ?>
                                                <li data-target='#carouselEvaluation' data-slide-to='<?= $i ?>' class='active'></li>
                                            <?php } else { ?>
                                                <li data-target='#carouselEvaluation' data-slide-to='<?= $i ?>'></li>
                                            <?php }
                                        } ?>
                                        </ol>
                                    <?php } ?>
                                    <div class="carousel-inner">
                                    <?php for ($i = 0; $i < count($donnees['images']); $i++) {
                                        if ($i == 0) { ?>
                                            <div class="carousel-item active">
                                        <?php } else { ?>
                                            <div class="carousel-item">
                                        <?php } ?>
                                            <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeu']->getJeuxId() ?>"><img class="d-block w-100" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="<?= $donnees['jeu']->getTitre() ?>"></a>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    <?php if (count($donnees['images']) > 1) { ?>
                                        <a class="carousel-control-prev" href="#carouselEvaluation" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselEvaluation" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </section>
                        </div>
                        <section class="d-flex justify-content-around mt-3">
                            <h3 class="text-center text-danger m-3"><?= (isset($donnees["succes"]) ? $donnees["succes"] : "") ?></h3>
                        </section>
                    <?php } else { ?>
                        <section class="my-5 py-5">
                            <h3 class="text-center m-3"><?= $donnees["erreur"] ?></h3>
                        </section>
                    <?php } ?>
                </div>
            </div>