<?php if (isset($_SESSION["type"]) && ($_SESSION["type"] == 3 || $_SESSION["type"] == 2)) { ?>
    <h1 class="text-center my-3">Adminstration</h1>
    <div class="d-flex container">

        <div class="nav flex-column nav-pills m-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link <?= isset($donnees['tab']) && $donnees['tab'] == 1 ? "active" : "" ?>" id="membres-tab" data-toggle="pill" href="#membres" role="tab" aria-controls="v-pills-home" aria-selected="true">Gérer les membres</a>
            <a class="nav-link <?= isset($donnees['tab']) && $donnees['tab'] == 2 ? "active" : "" ?>" id="jeux-tab" data-toggle="pill" href="#jeux" role="tab" aria-controls="v-pills-profile" aria-selected="false">Gérer les jeux</a>
            <a class="nav-link <?= isset($donnees['tab']) && $donnees['tab'] == 3 ? "active" : "" ?>" id="transactions-tab" data-toggle="pill" href="#transactions" role="tab" aria-controls="v-pills-messages" aria-selected="false">Gérer les transactions</a>
            <a class="nav-link <?= isset($donnees['tab']) && $donnees['tab'] == 4 ? "active" : "" ?>" id="menus-tab" data-toggle="pill" href="#menus" role="tab" aria-controls="v-pills-settings" aria-selected="false">Gérer les menus</a>
        </div>

        <div class="tab-content" id="v-pills-tabContent m-1">
            <!--Tableau gérer les membres-->
            <div class="tab-pane fade <?= $donnees['tab'] == 1 ? "show active" : "" ?> table-responsive" id="membres" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <table class="table table-hover ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Courriel</th>
                        <th scope="col">Type</th>
                        <th class="text-center" colspan="3" scope="col">Opération</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($donnees['membres']); $i++) {
                        if ($donnees['membres'][$i]->getTypeUtilisateur() != 3 || ($donnees['membres'][$i]->getTypeUtilisateur() == 3 && $_SESSION["type"] == 3)) { ?>
                            <tr class="<?= $donnees['membres'][$i]->getMembreActif() ? "" : "text-danger" ?> <?= $donnees['membres'][$i]->getTypeUtilisateur() == 1 ? "" : "text-success" ?>">
                                <td><?= $donnees['membres'][$i]->getMembreId(); ?></td>
                                <td><?= ($_SESSION["type"] == 3 || ($_SESSION["type"] == 2 && $donnees['membres'][$i]->getTypeUtilisateur() == 1) || $_SESSION["id"] == $donnees['membres'][$i]->getMembreId() ? '<a href="index.php?Membres&action=formModifierMembre&membreId=' . $donnees['membres'][$i]->getMembreId() . '">' . $donnees['membres'][$i]->getPrenom() . ' ' . $donnees['membres'][$i]->getNom() . '</a>' : $donnees['membres'][$i]->getPrenom() . ' ' . $donnees['membres'][$i]->getNom()) ?></td>
                                <td><?= $donnees['membres'][$i]->getCourriel() ?></td>
                                <td><?= $donnees['typeMembre'][$i]; ?></td>
                                <?php if ($donnees['membres'][$i]->getMembreValide() == 0) { ?>
                                    <td>
                                        <a href="index.php?Admin&action=validerMembre&membre_id=<?= $donnees['membres'][$i]->getMembreId(); ?>" class="btn btn-success m-1">Valider</a>
                                    </td>
                                <?php } else {
                                    if ($donnees['membres'][$i]->getMembreValide() && $donnees['membres'][$i]->getTypeUtilisateur() != 3 && $donnees['membres'][$i]->getMembreActif() && ($_SESSION["type"] == 3 || ($_SESSION["type"] == 2 && $donnees['membres'][$i]->getTypeUtilisateur() == 1))) { ?>
                                        <td>
                                            <a href="index.php?Admin&action=bannirMembre&membre_id=<?= $donnees['membres'][$i]->getMembreId(); ?>" class="btn btn-outline-danger m-1">Bannir</a>
                                        </td>
                                    <?php }
                                    if (!$donnees['membres'][$i]->getMembreActif()) { ?>
                                        <td>
                                            <a href="index.php?Admin&action=reactiverMembre&membre_id=<?= $donnees['membres'][$i]->getMembreId(); ?>" class="btn btn-outline-warning m-1">Dé-bannir</a>
                                        </td>
                                    <?php }
                                    if ($donnees['membres'][$i]->getTypeUtilisateur() == 1 && $_SESSION["type"] == 3 && $donnees['membres'][$i]->getMembreActif() && $donnees['membres'][$i]->getMembreValide()) { ?>
                                        <td>
                                            <a href="index.php?Admin&action=promouvoirMembre&membre_id=<?= $donnees['membres'][$i]->getMembreId(); ?>" class="btn btn-outline-primary m-1">Promouvoir</a>
                                        </td>
                                    <?php }
                                    if ($_SESSION["type"] == 3 && $donnees['membres'][$i]->getTypeUtilisateur() == 2) { ?>
                                        <td>
                                            <a href="index.php?Admin&action=demouvoirMembre&membre_id=<?= $donnees['membres'][$i]->getMembreId(); ?>" class="btn btn-outline-info m-1">Rétrograder</a>
                                        </td>
                                    <?php }
                                } ?>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>

            <!--Tableau gérer les jeux-->
            <div class="tab-pane fade <?= $donnees['tab'] == 2 ? "show active" : "" ?> table-responsive" id="jeux" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <table class="table table-hover ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Propriétaire</th>
                        <th scope="col">Transaction</th>
                        <th class="text-center" colspan="3" scope="col">Opération</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
                        <tr class="<?= $donnees['jeux'][$i]->getJeuxValide() == 0 ? "text-success" : ($donnees['jeux'][$i]->getJeuxBanni() == 1 ? "text-danger" : ($donnees['jeux'][$i]->getJeuxActif() == 0 ? "text-muted" : "")) ?>">
                            <td><?= $donnees['jeux'][$i]->getJeuxId() ?></td>
                            <td>
                                <a href='index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>'>
                                <img src="<?= $donnees['images'][$i]->getCheminPhoto(); ?>" class="img-thumbnail miniature"></a>
                            </td>
                            <td>
                                <a href='index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>'><?= $donnees['jeux'][$i]->getTitre() ?></a>
                            </td>
                            <td><?= $donnees['membreJeu'][$i]->getPrenom() . ' ' . $donnees['membreJeu'][$i]->getNom() ?></td>
                            <td><?= $donnees['jeux'][$i]->getLocation() == 1 ? "Location" : "Vente" ?></td>
                            <?php if ($donnees['jeux'][$i]->getJeuxValide() == 0) { ?>
                                <td>
                                    <a href="index.php?Admin&action=validerJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId(); ?>" class="btn btn-success m-1">Valider</a>
                                </td>
                            <?php } else {
                                if ($donnees['jeux'][$i]->getJeuxActif() == 0) { ?>
                                    <td>
                                        <a href="index.php?Admin&action=activerJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId(); ?>" class="btn btn-outline-success m-1">Activer</a>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <a href="index.php?Admin&action=desactiverJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId(); ?>" class="btn btn-outline-info m-1">Désactiver</a>
                                    </td>
                                <?php }
                                if ($donnees['jeux'][$i]->getlocation() == 1) {
                                    if ($donnees['jeux'][$i]->getJeuxBanni() == 0) { ?>
                                        <td>
                                            <a href="index.php?Admin&action=bannirJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId(); ?>" class="btn btn-outline-danger m-1">Bannir</a>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <a href="index.php?Admin&action=debannirJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId(); ?>" class="btn btn-outline-warning m-1">Dé-bannir</a>
                                        </td>
                                    <?php }
                                } else { 
                                    if ($donnees['jeux'][$i]->getJeuxBanni() == 1) { ?>
                                    <td>
                                        <button type="button" class="btn btn-outline-success" disabled>Vendu</button>
                                    </td>
                                    <?php }
                                }
                            } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Tableau gérer les transactions-->
            <div class="tab-pane fade <?= $donnees['tab'] == 3 ? "show active" : "" ?> table-responsive" id="transactions" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <nav>
                    <div id="nav-tab" class="nav nav-tabs row mx-0" role="tablist">
                        <a class="nav-item nav-link col-6 active" id="nav-locations-tab" data-toggle="tab" href="#locations-tab" role="tab" aria-controls="nav-fiches" aria-selected="true"><h2>Locations</h2></a>
                        <a class="nav-item nav-link col-6" id="nav-achats-tab" data-toggle="tab" href="#achats-tab" role="tab" aria-controls="nav-carte" aria-selected="false"><h2>Achats</h2></a>
                    </div>
                </nav>
                <div id="nav-tabContent" class="tab-content border-left border-right border-bottom">
                    <!--Tableau de location-->
                    <section id="locations-tab" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-locations-tab">
                        <h5 class="text-center p-4">Locations</h5>
                        <table class="table table-hover ">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Titre jeux</th>
                                <th scope="col">Propriétaire</th>
                                <th scope="col">Locataire</th>
                                <th scope="col">Paiement</th>
                                <th scope="col">Date début</th>
                                <th scope="col">Date retour</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($donnees['locations']); $i++) { ?>
                                <tr>
                                    <td><?= $donnees['locations'][$i]->getLocationId() ?></td>
                                    <td>
                                        <a href='index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees['jeuLocation'][$i]->getJeuxId() ?>'><?= $donnees['jeuLocation'][$i]->getTitre() ?></a>
                                    </td>
                                    <td><?= $donnees['proprietaireJeuLocation'][$i]->getPrenom() . ' ' . $donnees['proprietaireJeuLocation'][$i]->getNom() ?></td>
                                    <td><?= $donnees['membreLocation'][$i]->getPrenom() . ' ' . $donnees['membreLocation'][$i]->getNom() ?></td>
                                    <td><?= $donnees['typePaiementLocation'][$i]->getTypePaiement() ?> </td>
                                    <td><?= $donnees['locations'][$i]->getDateDebut(); ?> </td>
                                    <td><?= $donnees['locations'][$i]->getDateRetour(); ?> </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </section>
                    <!--Tableau d`achat-->
                    <section id="achats-tab" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-achats-tab">
                        <h5 class="text-center p-4">Achats</h5>
                        <table class="table table-hover ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Titre jeux</th>
                                    <th scope="col">Propriétaire</th>
                                    <th scope="col">Acheteur</th>
                                    <th scope="col">Paiement</th>
                                    <th scope="col">Date d'achat</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($donnees['achats']); $i++)  : ?>
                                <tr>
                                    <td><?= $donnees['achats'][$i]->getAchatId() ?></td>
                                    <td>
                                        <a href='index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees['jeuAchat'][$i]->getJeuxId() ?>'><?= $donnees['jeuAchat'][$i]->getTitre() ?></a>
                                    </td>
                                    <td><?= $donnees['proprietaireJeuAchat'][$i]->getPrenom() . ' ' . $donnees['proprietaireJeuAchat'][$i]->getNom() ?></td>
                                    <td><?= $donnees['membreAchat'][$i]->getPrenom() . ' ' . $donnees['membreAchat'][$i]->getNom() ?></td>
                                    <td><?= $donnees['typePaiementAchat'][$i]->getTypePaiement() ?> </td>
                                    <td><?= $donnees['achats'][$i]->getDateAchat() ?> </td>
                                </tr>
                            <?php endfor; ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

            <!--Tableau gérer les menus-->
            <div class="tab-pane fade <?= $donnees['tab'] == 4 ? "show active" : "" ?> table-responsive" id="menus" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="container mt-5">
                    <div class="row">
                    <!-- Catégories -->
                        <div class="col-lg-6">
                            <h2 class="text-center">Catégories
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success ml-3" data-toggle="modal"
                                        data-target="#categorie">
                                    Ajouter
                                </button>
                            </h2>
                            <!-- Modal categorie -->
                            <div class="modal fade" id="categorie" tabindex="-1" role="dialog" aria-labelledby="categorieLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                                            <button type="button" class="close " data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                                <input type="submit" class="btn btn-primary" value="Enregistrer">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover ">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Catégorie</th>
                                    <th class="text-center" colspan="2" scope="col">Opération</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($i = 0;
                                    $i < count($donnees['categories']);
                                    $i++): ?>
                                    <tr>
                                        <td class="col-lg-5"><?= $donnees['categories'][$i]->getCategorieId() ?></td>
                                        <td class="col-lg-5"><?= $donnees['categories'][$i]->getCategorie() ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary ml-3" data-toggle="modal" data-target="#categorie" onclick="modifierCategorie(<?= $donnees['categories'][$i]->getCategorieId() ?>, '<?= $donnees['categories'][$i]->getCategorie() ?>')">
                                                Modifier
                                            </button>
                                        </td>
                                        <td>
                                        <?php if ($donnees['categories'][$i]->getCategorieActive() == 0) { ?>
                                            <a href="index.php?Admin&action=activerCategorie&categorie_id=<?= $donnees['categories'][$i]->getCategorieId(); ?>" class="btn btn-sm btn-outline-success m-1">Activer</a>
                                        <?php } else { ?>
                                            <a href="index.php?Admin&action=desactiverCategorie&categorie_id=<?= $donnees['categories'][$i]->getCategorieId(); ?>" class="btn btn-sm btn-outline-danger m-1">Désactiver</a>
                                        <?php } ?>
                                        </td>
                                    <tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Plateformes -->
                        <div class="col-lg-6">
                            <h2 class="text-center">Plateforme
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success ml-3" data-toggle="modal"
                                        data-target="#plateforme">
                                    Ajouter
                                </button>
                            </h2>
                            <!-- Modal plateforme -->
                            <div class="modal fade" id="plateforme" tabindex="-1" role="dialog" aria-labelledby="plateformeLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une plateforme</h5>
                                            <button type="button" class="close " data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                                <input type="submit" class="btn btn-primary" value="Enregistrer">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover ">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Plateforme</th>
                                    <th class="text-center" colspan="2" scope="col">Opération</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($i = 0; $i < count($donnees['plateformes']); $i++): ?>
                                    <tr>
                                        <td><?= $donnees['plateformes'][$i]->getPlateformeId() ?></td>
                                        <td><?= $donnees['plateformes'][$i]->getPlateforme() ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary ml-3" data-toggle="modal" data-target="#plateforme" onclick="modifierPlateforme(<?= $donnees['plateformes'][$i]->getPlateformeId() ?>, '<?= $donnees['plateformes'][$i]->getPlateforme() ?>')">
                                                Modifier
                                            </button>
                                        </td>
                                        <td>
                                        <?php if ($donnees['plateformes'][$i]->getPlateformeActive() == 0) { ?>
                                            <a href="index.php?Admin&action=activerPlateforme&plateforme_id=<?= $donnees['plateformes'][$i]->getPlateformeId(); ?>" class="btn btn-sm btn-outline-success m-1">Activer</a>
                                        <?php } else { ?>
                                            <a href="index.php?Admin&action=desactiverPlateforme&plateforme_id=<?= $donnees['plateformes'][$i]->getPlateformeId(); ?>" class="btn btn-sm btn-outline-danger m-1">Désactiver</a>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <h3 class='text-center my-5'>Vous n'avez pas droit d'acceder à cette page!!!</h3>
<?php } ?>

<script>

    function modifierCategorie(id, categorie) {
        $("#categorie input[type='number']").val(id);
        $("#categorie input:text").val(categorie);
    }

    function modifierPlateforme(id, plateforme) {
        $("#plateforme input[type='number']").val(id);
        $("#plateforme input:text").val(plateforme);
    }

</script>
