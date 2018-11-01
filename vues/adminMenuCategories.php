                            <h5 class="text-center p-4">
                                Catégories
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-success ml-3" data-toggle="modal" data-target="#categoriesModal" onclick="nouvelleCategorie()">Ajouter</button>
                            </h5>
                            <!-- Modal Categorie -->
                            <div class="modal fade" id="categoriesModal" tabindex="-1" role="dialog" aria-labelledby="categoriesModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="categoriesModalLabel"><span>Ajouter une catégorie</span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <form action="index.php?Admin&action=sauvegarderCategorie" method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="modification">Nouvelle catégorie</label>
                                                    <input type="text" id="categorie" name="categorie" value="">
                                                    <input type="number" id="categorie_id" name="categorie_id" hidden value="0">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                                                <button type="button" class="btn btn-sm btn-primary m-1" onclick="sauvegarderCategorie()">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Tableau Categories -->
                            <div class="mx-auto">
                                <!-- <table class="table table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Catégorie</th>
                                            <th class="text-center" colspan="2" scope="col">Opération</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php for ($i = 0; $i < count($donnees['categories']); $i++) { ?>
                                        <tr>
                                            <td class="col-lg-5"><?= $donnees['categories'][$i]->getCategorieId() ?></td>
                                            <td class="col-lg-5"><?= $donnees['categories'][$i]->getCategorie() ?></td>
                                            <td><button type="button" class="btn btn-sm btn-outline-primary m-1" data-toggle="modal" data-target="#categoriesModal" onclick="modifierCategorie(<?= $donnees['categories'][$i]->getCategorieId() ?>, '<?= $donnees['categories'][$i]->getCategorie() ?>')">Modifier</button></td>
                                            <td>
                                            <?php if ($donnees['categories'][$i]->getCategorieActive() == 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-success m-1" onclick="activerCategorie(<?= $donnees['categories'][$i]->getCategorieId(); ?>)">Activer</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="desactiverCategorie(<?= $donnees['categories'][$i]->getCategorieId(); ?>)">Désactiver</button>
                                            <?php } ?>
                                            </td>
                                        <tr>
                                    <?php } ?>
                                    </tbody>
                                </table> -->
                                <table class="table table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Catégorie</th>
                                            <th class="text-center" colspan="2" scope="col">Opération</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php for ($i = 0; $i < count($donnees['categories']); $i++) { ?>
                                        <tr class="<?= $donnees['categories'][$i]->getCategorieActive() ? "" : "text-danger" ?>">
                                            <td><?= $donnees['categories'][$i]->getCategorieId() ?></td>
                                            <td><?= $donnees['categories'][$i]->getCategorie() ?></td>
                                            <td><button type="button" class="btn btn-sm btn-outline-primary m-1" data-toggle="modal" data-target="#categoriesModal" onclick="modifierCategorie(<?= $donnees['categories'][$i]->getCategorieId() ?>, '<?= $donnees['categories'][$i]->getCategorie() ?>')">Modifier</button></td>
                                            <td>
                                            <?php if ($donnees['categories'][$i]->getCategorieActive() == 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateCategorie(<?= $donnees['categories'][$i]->getCategorieId() ?>, 'activerCategorie')">Activer</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateCategorie(<?= $donnees['categories'][$i]->getCategorieId() ?>, 'desactiverCategorie')">Désactiver</button>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>