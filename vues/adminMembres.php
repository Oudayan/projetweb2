                <h3 class="text-center m-4">Gestion des membres</h3>
                <table class="table table-responsive-md ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Courriel</th>
                        <th scope="col">Type</th>
                        <th scope="col">Évaluation</th>
                        <th class="text-center" colspan="4" scope="col">Opération</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($donnees['membres']); $i++) {
                        if ($donnees['membres'][$i]->getTypeUtilisateur() != 3 || ($donnees['membres'][$i]->getTypeUtilisateur() == 3 && $_SESSION["type"] == 3)) { ?>
                            <tr class="<?= $donnees['membres'][$i]->getMembreActif() ? "" : "text-danger" ?> <?= $donnees['membres'][$i]->getTypeUtilisateur() == 1 ? "" : "text-success" ?>">
                                <td><?= $donnees['membres'][$i]->getMembreId() ?></td>
                                <td><?= $donnees['membres'][$i]->getPrenom() . ' ' . $donnees['membres'][$i]->getNom() ?></td>
                                <td><?= $donnees['membres'][$i]->getCourriel() ?></td>
                                <td><?= $donnees['typeMembre'][$i]; ?></td>
                                <td>
                                <?php if($donnees["membres"][$i]->getEvaluationGlobale() >= 0){ ?>
                                    <span class="score"><span style="width: <?= ($donnees["membres"][$i]->getEvaluationGlobale() / 5) * 100 ?>%"></span></span>
                                    (<?= round($donnees["membres"][$i]->getEvaluationGlobale(), 2) ?>&nbsp;/&nbsp;5)
                                <?php } else { ?>
                                    <span>Membre non&nbsp;évalué</span>
                                <?php } ?>
                                </td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary m-1" onclick="modifierMembre(<?= $donnees['membres'][$i]->getMembreId() ?>)">Modifier</button></td>
                                <?php if ($donnees['membres'][$i]->getMembreValide() == 0) { ?>
                                    <td><button type="button" class="btn btn-sm btn-success m-1" onclick="updateMembre(<?= $donnees['membres'][$i]->getMembreId() ?>, 'validerMembre')">Valider</button></td>
                                <?php } else {
                                    if ($donnees['membres'][$i]->getMembreValide() && $donnees['membres'][$i]->getTypeUtilisateur() != 3 && $donnees['membres'][$i]->getMembreActif() && ($_SESSION["type"] == 3 || ($_SESSION["type"] == 2 && $donnees['membres'][$i]->getTypeUtilisateur() == 1))) { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateMembre(<?= $donnees['membres'][$i]->getMembreId() ?>, 'bannirMembre')">Bannir</button></td>
                                    <?php }
                                    if (!$donnees['membres'][$i]->getMembreActif()) { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-warning m-1" onclick="updateMembre(<?= $donnees['membres'][$i]->getMembreId() ?>, 'reactiverMembre')">Dé-bannir</button></td>
                                    <?php }
                                    if ($donnees['membres'][$i]->getTypeUtilisateur() == 1 && $_SESSION["type"] == 3 && $donnees['membres'][$i]->getMembreActif() && $donnees['membres'][$i]->getMembreValide()) { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateMembre(<?= $donnees['membres'][$i]->getMembreId() ?>, 'promouvoirMembre')">Promouvoir</button></td>
                                    <?php }
                                    if ($_SESSION["type"] == 3 && $donnees['membres'][$i]->getTypeUtilisateur() == 2) { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-info m-1" onclick="updateMembre(<?= $donnees['membres'][$i]->getMembreId() ?>, 'retrograderMembre')">Rétrograder</button></td>
                                    <?php }
                                } ?>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>