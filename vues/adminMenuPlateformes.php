                            <!-- <div class="d-flex justify-content-center align-content-center"> -->
                            <h5 class="text-center p-4">
                                Plateforme
                                <button type="button" class="btn btn-sm btn-success ml-3" data-toggle="modal" data-target="#plateformesModal" onclick="nouvellePlateforme()">Ajouter</button>
                            </h5>
                            <!-- Modal plateforme -->
                            <div class="modal hide fade" id="plateformesModal" tabindex="-1" role="dialog" aria-labelledby="plateformesModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="plateformesModalLabel"><span>Ajouter une plateforme</span></h5>
                                            <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <form action="index.php?Admin&action=sauvegarderPlateforme" method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="plateforme">Nouvelle plateforme</label>
                                                    <input type="text" id="plateforme" name="plateforme" value="">
                                                    <input type="number" id="plateforme_id" name="plateforme_id" hidden value="0">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                                                <button type="button" class="btn btn-sm btn-primary m-1" onclick="sauvegarderPlateforme()">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Tableau Plateformes -->
                            <div class="mx-auto">
                                <table class="table table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Plateforme</th>
                                            <th class="text-center" colspan="2" scope="col">Opération</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php for ($i = 0; $i < count($donnees['plateformes']); $i++) { ?>
                                        <tr class="<?= $donnees['plateformes'][$i]->getPlateformeActive() ? "" : "text-danger" ?>">
                                            <td><?= $donnees['plateformes'][$i]->getPlateformeId() ?></td>
                                            <td><?= $donnees['plateformes'][$i]->getPlateforme() ?></td>
                                            <td><button type="button" class="btn btn-sm btn-outline-primary m-1" data-toggle="modal" data-target="#plateformesModal" onclick="modifierPlateforme(<?= $donnees['plateformes'][$i]->getPlateformeId() ?>, '<?= $donnees['plateformes'][$i]->getPlateforme() ?>')">Modifier</button></td>
                                            <td>
                                            <?php if ($donnees['plateformes'][$i]->getPlateformeActive() == 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updatePlateforme(<?= $donnees['plateformes'][$i]->getPlateformeId() ?>, 'activerPlateforme')">Activer</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updatePlateforme(<?= $donnees['plateformes'][$i]->getPlateformeId() ?>, 'desactiverPlateforme')">Désactiver</button>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
