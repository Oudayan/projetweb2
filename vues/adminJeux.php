                <h3 class="text-center m-4">Gestion des jeux</h3>
                <table class="table table-responsive-md ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th colspan="2" scope="col">Jeu</th>
                        <th scope="col">Propriétaire</th>
                        <th scope="col">Transaction</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Évaluation</th>
                        <th class="text-center" colspan="4" scope="col">Opération</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
                        <tr class="<?= $donnees['jeux'][$i]->getJeuxValide() == 0 ? "text-success" :($donnees['jeux'][$i]->getVendu() == 1 ? "text-muted" :  ($donnees['jeux'][$i]->getJeuxBanni() == 1 ? "text-danger" : ($donnees['jeux'][$i]->getJeuxActif() == 0 ? "text-danger" : ""))) ?>">
                            <td>
                                <?= $donnees['jeux'][$i]->getJeuxId() ?>
                            </td>
                            <td><img src="<?= $donnees['images'][$i]->getCheminPhoto(); ?>" class="img-thumbnail miniature"></td>
                            <td><?= $donnees['jeux'][$i]->getTitre() ?></td>
                            <td><?= $donnees['membreJeu'][$i]->getPrenom() . ' ' . $donnees['membreJeu'][$i]->getNom() ?></td>
                            <td><?= $donnees['jeux'][$i]->getLocation() == 1 ? "Location" : "Vente" ?></td>
                            <td><?= $donnees['jeux'][$i]->getPrix() ?>&nbsp;$</td>
                            <td>
                            <?php if($donnees["jeux"][$i]->getEvaluationGlobale() >= 0){ ?>
                                <span class="score"><span style="width: <?= ($donnees["jeux"][$i]->getEvaluationGlobale() / 5) * 100 ?>%"></span></span>
                                <br><small>(<?= round($donnees["jeux"][$i]->getEvaluationGlobale(), 2) ?>/5) <?= $donnees['nbEvaluationsJeux'][$i][0] . " " . ($donnees['nbEvaluationsJeux'][$i][0] > 1 ? "évaluations" : "évaluation") ?></small>
                            <?php } else { ?>
                                <span>Jeu&nbsp;non évalué</span>
                            <?php } ?>
                            </td>
                            <td><button type="button" class="btn btn-sm btn-outline-primary m-1" onclick="modifierJeu(<?= $donnees['jeux'][$i]->getJeuxId() ?>)">Modifier</button></td>
                            <?php if ($donnees['jeux'][$i]->getJeuxValide() == 0) { ?>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success m-1" onclick="updateJeu(<?= $donnees['jeux'][$i]->getJeuxId() ?>, 'validerJeu')">Valider</button>
                                </td>
                            <?php } else if ($donnees['jeux'][$i]->getLocation() == 0 && $donnees['jeux'][$i]->getVendu() == 1) { ?>
                                <td><button type="button" class="btn btn-sm btn-outline-success m-1" disabled>Vendu</button></td>
                            <?php } else {
                                if ($donnees['jeux'][$i]->getJeuxActif() == 0) { ?>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateJeu(<?= $donnees['jeux'][$i]->getJeuxId() ?>, 'activerJeu')" <?= $donnees['membreJeu'][$i]->getMembreActif() == 0 ? "disabled" : "" ?>>Réactiver</button>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-info m-1" onclick="updateJeu(<?= $donnees['jeux'][$i]->getJeuxId() ?>, 'desactiverJeu')">Désactiver</button>
                                    </td>
                                <?php }
                                if ($donnees['jeux'][$i]->getJeuxBanni() == 0) { ?>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateJeu(<?= $donnees['jeux'][$i]->getJeuxId() ?>, 'bannirJeu')">Bannir</button>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-warning m-1" onclick="updateJeu(<?= $donnees['jeux'][$i]->getJeuxId(); ?>, 'debannirJeu')">Dé-bannir</button>
                                    </td>
                                <?php }
                            } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>