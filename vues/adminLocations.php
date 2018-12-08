                        <h5 class="text-center p-4">Locations</h5>
                        <table class="table table-responsive-md">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Titre jeux</th>
                                <th scope="col">Propriétaire</th>
                                <th scope="col">Locataire</th>
                                <th scope="col">Paiement</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Date location</th>
                                <th scope="col">Date début</th>
                                <th scope="col">Date retour</th>
                                <th scope="col">Opération</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($donnees['locations']); $i++) { ?>
                                <tr class="<?= $donnees['locations'][$i]->getLocationActive() ? "" : "text-danger" ?>">
                                    <td><?= $donnees['locations'][$i]->getLocationId() ?></td>
                                    <td><?= $donnees['jeuLocation'][$i]->getTitre() ?></td>
                                    <td><?= $donnees['proprietaireJeuLocation'][$i]->getPrenom() . ' ' . $donnees['proprietaireJeuLocation'][$i]->getNom() ?></td>
                                    <td><?= $donnees['membreLocation'][$i]->getPrenom() . ' ' . $donnees['membreLocation'][$i]->getNom() ?></td>
                                    <td><?= $donnees['typePaiementLocation'][$i]->getTypePaiement() ?> </td>
                                    <td><?= $donnees['locations'][$i]->getPrixLocation() ?> <small>$CAD</small></td>
                                    <td><?= $donnees['locations'][$i]->getDateLocation() ?></td>
                                    <td><?= date('Y-m-d', strtotime($donnees['locations'][$i]->getDateDebut())) ?></td>
                                    <td><?= date('Y-m-d', strtotime($donnees['locations'][$i]->getDateRetour())) ?></td>
                                    <?php if ($donnees['locations'][$i]->getLocationActive() == 0) { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateLocation(<?= $donnees['locations'][$i]->getLocationId() ?>, 'activerLocation')">Réactiver</button></td>
                                    <?php } else { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateLocation(<?= $donnees['locations'][$i]->getLocationId() ?>, 'desactiverLocation')">Annuler</button></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>