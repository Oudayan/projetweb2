                <h3 class="text-center m-4">Gestion des évaluations</h3>
                <table class="table table-responsive-md ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th colspan="2" scope="col">Jeu</th>
                            <th scope="col">Propriétaire</th>
                            <th scope="col">Évaluateur</th>
                            <th scope="col">Date</th>
                            <th scope="col">Éval. Jeu</th>
                            <th scope="col">Éval. Membre</th>
                            <th class="text-center" colspan="3" scope="col">Opération</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($donnees["evaluations"]); $i++) { ?>
                        <tr class="<?= $donnees["evaluations"][$i]->getEvaluationJeuActive() == 0 && $donnees["evaluations"][$i]->getEvaluationMembreActive() == 0 ? "text-danger" : ( $donnees["evaluations"][$i]->getEvaluationJeuActive() == 0 || $donnees["evaluations"][$i]->getEvaluationMembreActive() == 0 ? "text-warning" : "") ?>">
                            <td><?= $donnees["evaluations"][$i]->getEvaluationId() ?></td>
                            <td><img src="<?= $donnees["images"][$i]->getCheminPhoto(); ?>" class="img-thumbnail miniature"></td>
                            <td><?= $donnees["jeuEvalue"][$i]->getTitre() ?></td>
                            <td><?= $donnees["proprietaireJeuEvalue"][$i]->getPrenom() . " " . $donnees["proprietaireJeuEvalue"][$i]->getNom() ?></td>
                            <td><?= $donnees["membreEvaluateur"][$i]->getPrenom() . " " . $donnees["membreEvaluateur"][$i]->getNom() ?></td>
                            <td><?= date('Y-m-d', strtotime($donnees["evaluations"][$i]->getDateEvaluation())) ?></td>
                            <td>
                            <?php if ($donnees["evaluations"][$i]->getEvaluationJeu() >= 0) { ?>
                                <span class="score"><span style="width: <?= ($donnees["evaluations"][$i]->getEvaluationJeu() / 5) * 100 ?>%"></span></span>
                                <small>(<?= round($donnees["evaluations"][$i]->getEvaluationJeu(), 2) ?>/5)</small>
                            <?php } else { ?>
                                <span>Jeu&nbsp;non évalué</span>
                            <?php } ?>
                            </td>
                            <td>
                            <?php if ($donnees["evaluations"][$i]->getEvaluationMembre() >= 0) { ?>
                                <span class="score"><span style="width: <?= ($donnees["evaluations"][$i]->getEvaluationMembre() / 5) * 100 ?>%"></span></span>
                                <small>(<?= round($donnees["evaluations"][$i]->getEvaluationMembre(), 2) ?>/5)</small>
                            <?php } else { ?>
                                <span>Membre&nbsp;non évalué</span>
                            <?php } ?>
                            </td>
                            <td><button type="button" class="btn btn-sm btn-outline-primary m-1" onclick="modifierEvaluation('<?= $donnees['evaluations'][$i]->getJeton() ?>')">Modifier</button></td>
                            <?php if ($donnees["evaluations"][$i]->getEvaluationJeu() >= 0) {
                                if ($donnees['evaluations'][$i]->getEvaluationJeuActive() == 0) { ?>
                                    <td><button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateEvaluation(<?= $donnees['evaluations'][$i]->getEvaluationId() ?>, 'activerEvaluationJeu')">Réactiver<br>éval.&nbsp;jeu</button></td>
                                <?php } else { ?>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateEvaluation(<?= $donnees['evaluations'][$i]->getEvaluationId() ?>, 'desactiverEvaluationJeu')">Annuler<br>éval.&nbsp;jeu</button></td>
                                <?php }
                            }
                            if ($donnees["evaluations"][$i]->getEvaluationMembre() >= 0) {
                                if ($donnees['evaluations'][$i]->getEvaluationMembreActive() == 0) { ?>
                                    <td><button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateEvaluation(<?= $donnees['evaluations'][$i]->getEvaluationId() ?>, 'activerEvaluationMembre')">Réactiver<br>éval.&nbsp;membre</button></td>
                                <?php } else { ?>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateEvaluation(<?= $donnees['evaluations'][$i]->getEvaluationId() ?>, 'desactiverEvaluationMembre')">Annuler<br>éval.&nbsp;membre</button></td>
                                <?php }
                            } ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>